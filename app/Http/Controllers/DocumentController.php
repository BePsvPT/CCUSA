<?php

namespace App\Http\Controllers;

use App\Attachments\Attachment;
use App\Documents\Document;
use App\Http\Requests\DocumentRequest;
use Auth;
use Illuminate\Support\Str;
use Response;

class DocumentController extends Controller
{
    /**
     * DocumentController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);

        $this->middleware('role:documents', ['except' => ['index', 'show']]);
    }

    /**
     * Get documents list.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $documents = Document::with(['attachments']);

        if (Auth::guest()) {
            $documents = $documents->where('published', true);
        }

        $documents = $documents->latest()->get()->groupBy('group');

        return view('documents.index', compact('documents'));
    }

    /**
     * Show the creating form.
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DocumentRequest $request)
    {
        $document = (new Document($request->only(['group'])))
            ->setAttribute('published', $request->input('published', 0));

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
     * Download the attachment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $documents = Document::with(['attachments']);

        if (Auth::guest()) {
            $documents = $documents->where('published', true);
        }

        $attachment = $documents->findOrFail($id)->getRelation('attachments')->first();

        return Response::download($attachment->getPath(), $attachment->getAttribute('name'), [
            'content-type' => $attachment->getAttribute('mime_type'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = Document::with(['attachments'])->findOrFail($id);

        $groups = Document::groupBy(['group'])->get(['group'])->pluck('group', 'group');

        return view('documents.edit', compact('document', 'groups'));
    }

    /**
     * Update a specific document.
     *
     * @param DocumentRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DocumentRequest $request, $id)
    {
        $document = Document::with(['attachments'])->findOrFail($id);

        $document->fill($request->only(['group']))
            ->setAttribute('published', $request->input('published', 0));;

        $document->getRelation('attachments')->first()->fill($request->only(['name']));

        $document->push();

        return Response::redirectToRoute('documents.index');
    }


    /**
     * Delete a specific document.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Document::destroy($id);

        return $this->ok();
    }
}
