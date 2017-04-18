<?php

namespace App\Http\Controllers;

use App\Http\Requests\CooperativeStoreRequest;
use App\Models\CooperativeStore;
use Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CooperativeStoreController extends Controller
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->middleware('role:cooperative-stores', ['except' => ['index', 'show']]);
    }

    /**
     * Get cooperative store list.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $css = CooperativeStore::with('media')
            ->where('published', true)
            ->get();

        return view('cooperative-stores.index', compact('css'));
    }

    /**
     * Get cooperative store manage page.
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function manage(Request $request)
    {
        $css = new CooperativeStore;

        if ($request->has('keyword')) {
            $css = $css->where('name', 'like',  '%'.$request->input('keyword').'%');
        }

        $css = $css->simplePaginate();

        return view('cooperative-stores.manage', compact('css'));
    }

    /**
     * Get cooperative store create page.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('cooperative-stores.create');
    }

    /**
     * Create new cooperative store.
     *
     * @param CooperativeStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CooperativeStoreRequest $request)
    {
        $cs = new CooperativeStore();

        $this->save($cs, $request);

        return redirect()->route('cooperative-stores.index');
    }

    /**
     * Get cooperative store edit page.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $cs = CooperativeStore::findOrFail($this->transformParameters($id));

        return view('cooperative-stores.edit', compact('cs'));
    }

    /**
     * Update cooperative store.
     *
     * @param CooperativeStoreRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CooperativeStoreRequest $request, $id)
    {
        $cs = CooperativeStore::findOrFail($this->transformParameters($id));

        $this->save($cs, $request);

        return redirect()->route('cooperative-stores.index');
    }

    /**
     * Save cooperative store data to database.
     *
     * @param CooperativeStore $cs
     * @param Request $request
     */
    protected function save(CooperativeStore $cs, Request $request)
    {
        $cs->fill($request->only([
            'name', 'began_at', 'ended_at', 'phone',
            'address', 'description', 'business_hours',
        ]))
            ->setAttribute('published', boolval($request->input('published')))
            ->save();

        foreach (['cover', 'gallery'] as $type) {
            foreach ($request->file($type, []) as $file) {
                if ($request->isMethod('PATCH')) {
                    $cs->clearMediaCollection('cs-'.$type);
                }

                $cs->addMedia($file)
                    ->setFileName(Str::random(8).'.'.$file->guessExtension())
                    ->toCollection('cs-'.$type, 'media.cooperative-store');
            }
        }
    }

    /**
     * Delete the specific cooperative store.
     *
     * @param int $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        CooperativeStore::findOrFail($this->transformParameters($id))->delete();

        return $this->ok();
    }

    /**
     * Transform the cs parameter to original number.
     *
     * @param string $cs
     *
     * @return int
     */
    protected function transformParameters($cs)
    {
        $ids = Hashids::decode(array_last(explode('-', $cs)));

        if (empty($ids)) {
            throw new NotFoundHttpException;
        }

        return $ids[0];
    }
}
