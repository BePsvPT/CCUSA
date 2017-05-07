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
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $groups = CooperativeStore::groupBy(['group'])
            ->where('published', true)
            ->get(['group'])
            ->map(function (CooperativeStore $store) {
                return $store->getAttribute('group');
            })
            ->groupBy(function ($group) {
                return array_first(explode('-', $group));
            })
            ->toArray();

        $css = CooperativeStore::with('media')
            ->where('published', true);

        if ($request->has('group')) {
            $css->where('group', 'like', $request->input('group').'%');
        }

        $css = $css->simplePaginate(9);

        return view('cooperative-stores.index', compact('groups', 'css'));
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
            $css = $css->where('name', 'like', '%'.$request->input('keyword').'%');
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
        $groups = CooperativeStore::groupBy(['group'])
            ->get(['group'])
            ->pluck('group', 'group');

        return view('cooperative-stores.create', compact('groups'));
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

        return redirect()->route('cooperative-stores.manage');
    }

    /**
     * Show cooperative store information.
     *
     * @param string $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $cs = CooperativeStore::findOrFail($this->transformParameters($id));

        return view('cooperative-stores.show', compact('cs'));
    }

    /**
     * Get cooperative store edit page.
     *
     * @param string $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $groups = CooperativeStore::groupBy(['group'])
            ->get(['group'])
            ->pluck('group', 'group');

        $cs = CooperativeStore::findOrFail($this->transformParameters($id));

        return view('cooperative-stores.edit', compact('groups', 'cs'));
    }

    /**
     * Update cooperative store.
     *
     * @param CooperativeStoreRequest $request
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CooperativeStoreRequest $request, $id)
    {
        $cs = CooperativeStore::findOrFail($this->transformParameters($id));

        $this->save($cs, $request);

        return redirect()->route('cooperative-stores.manage');
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
            'name', 'began_at', 'ended_at', 'phone', 'address',
            'description', 'business_hours', 'group',
        ]))
            ->setAttribute('published', boolval($request->input('published')))
            ->save();

        foreach (['cover', 'gallery'] as $type) {
            if ($request->hasFile($type)) {
                $cs->clearMediaCollection('cs-'.$type);
            }

            foreach ($request->file($type, []) as $file) {
                $cs->addMedia($file)
                    ->setFileName(Str::random(8).'.'.$file->guessExtension())
                    ->toCollection('cs-'.$type, 'media.cooperative-store');
            }
        }
    }

    /**
     * Delete the specific cooperative store.
     *
     * @param string $id
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
