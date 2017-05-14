<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Models\Attachment;
use App\Models\Document;
use Illuminate\Support\Str;
use Response;

class DocumentController extends Controller
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('role:documents', ['except' => ['index', 'show']]);
    }

    /**
     * 文件首頁.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $documents = Document::with(['attachments'])
            ->guest()
            ->latest()
            ->get(['id', 'group', 'published'])
            ->groupBy('group');

        $this->og->title('學生會二三事 | 國立中正大學學生會')
            ->image(asset('assets/media/images/general/guide/document.png'));

        return view('documents.index', compact('documents'));
    }

    /**
     * 文件新增頁面.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $groups = $this->groups();

        return view('documents.create', compact('groups'));
    }

    /**
     * 新增文件.
     *
     * @param DocumentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DocumentRequest $request)
    {
        $document = (new Document($request->only(['group', 'published'])));

        $document->save();

        $attachment = $document->attachments()->save(new Attachment([
            'name'      => $request->input('name'),
            'file_name' => Str::random(6).'.'.$request->file('attachment')->guessExtension(),
            'mime_type' => $request->file('attachment')->getMimeType(),
            'size'      => $request->file('attachment')->getSize(),
        ]));

        $request->file('attachment')->move(
            $attachment->getDirectory(),
            $attachment->getAttribute('file_name')
        );

        return Response::redirectToRoute('documents.index');
    }

    /**
     * 下載文件.
     *
     * @param string $hashid
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show($hashid)
    {
        $attachment = Document::with(['attachments'])
            ->guest()
            ->findOrFail($this->decodeHashid($hashid))
            ->getRelation('attachments')
            ->first();

        $attachment->increment('downloads');

        return Response::download($attachment->getPath(), $attachment->getAttribute('name'), [
            'content-type' => $attachment->getAttribute('mime_type'),
        ]);
    }

    /**
     * 編輯文件.
     *
     * @param string $hashid
     *
     * @return \Illuminate\View\View
     */
    public function edit($hashid)
    {
        $document = Document::with(['attachments'])->findOrFail($this->decodeHashid($hashid));

        $groups = $this->groups();

        return view('documents.edit', compact('document', 'groups'));
    }

    /**
     * 更新文件.
     *
     * @param DocumentRequest $request
     * @param string $hashid
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DocumentRequest $request, $hashid)
    {
        $document = Document::with(['attachments'])->findOrFail($this->decodeHashid($hashid));

        $document->fill($request->only(['group', 'published']));

        $document->getRelation('attachments')->first()->fill($request->only(['name']));

        $document->push();

        return redirect()->route('documents.index');
    }

    /**
     * 刪除文件.
     *
     * @param string $hashid
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy($hashid)
    {
        Document::destroy($this->decodeHashid($hashid));

        return $this->ok();
    }

    /**
     * 文件群組.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function groups()
    {
        return Document::groupBy(['group'])
            ->get(['group'])
            ->pluck('group', 'group');
    }
}
