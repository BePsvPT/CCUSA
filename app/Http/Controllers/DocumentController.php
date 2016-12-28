<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Models\Attachment;
use App\Models\Document;
use Hashids;
use Illuminate\Support\Str;
use Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DocumentController extends Controller
{
    /**
     * DocumentController constructor.
     */
    public function __construct()
    {
        $this->middleware('role:documents', ['except' => ['index', 'show']]);
    }

    /**
     * Get the documents list page.
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

        return view('documents.index', compact('documents'));
    }

    /**
     * Get the document upload page.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $groups = Document::groupBy(['group'])->get(['group'])->pluck('group', 'group');

        return view('documents.create', compact('groups'));
    }

    /**
     * Create a document.
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
            'file_name' => Str::quickRandom(6).'.'.$request->file('attachment')->guessExtension(),
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
     * Download the document.
     *
     * @param string $hashid
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show($hashid)
    {
        $attachment = Document::with(['attachments'])
            ->guest()
            ->findOrFail($this->transformHashid($hashid))
            ->getRelation('attachments')
            ->first();

        $attachment->increment('downloads');

        return Response::download($attachment->getPath(), $attachment->getAttribute('name'), [
            'content-type' => $attachment->getAttribute('mime_type'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $hashid
     *
     * @return \Illuminate\View\View
     */
    public function edit($hashid)
    {
        $document = Document::with(['attachments'])->findOrFail($this->transformHashid($hashid));

        $groups = Document::groupBy(['group'])->get(['group'])->pluck('group', 'group');

        return view('documents.edit', compact('document', 'groups'));
    }

    /**
     * Update a specific document.
     *
     * @param DocumentRequest $request
     * @param string $hashid
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DocumentRequest $request, $hashid)
    {
        $document = Document::with(['attachments'])->findOrFail($this->transformHashid($hashid));

        $document->fill($request->only(['group', 'published']));

        $document->getRelation('attachments')->first()->fill($request->only(['name']));

        $document->push();

        return Response::redirectToRoute('documents.index');
    }

    /**
     * Delete the specific document.
     *
     * @param string $hashid
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy($hashid)
    {
        Document::destroy($this->transformHashid($hashid));

        return $this->ok();
    }

    /**
     * Transform the hashid to original number.
     *
     * @param string $hashid
     *
     * @return int
     */
    protected function transformHashid($hashid)
    {
        $ids = Hashids::decode($hashid);

        if (empty($ids)) {
            throw new NotFoundHttpException;
        }

        return $ids[0];
    }
}
