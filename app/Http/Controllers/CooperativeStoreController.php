<?php

namespace App\Http\Controllers;

use App\Http\Requests\CooperativeStoreRequest;
use App\Models\CooperativeStore;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CooperativeStoreController extends Controller
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('role:cooperative-stores', ['except' => ['index', 'show']]);
    }

    /**
     * 特約商店首頁.
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $groups = $this->classify();

        $css = CooperativeStore::with('media')
            // 過濾已結束的特約商店
            ->active()
            // 過濾未發布的特約商店
            ->published();

        // 如果有 group ，則只顯示該 group 的特約商店
        if ($request->has('group')) {
            $css->where('group', 'like', $request->input('group').'%');
        }

        $css = $css->simplePaginate(9);

        // 設定 facebook open graph
        $this->og->title('特約商店 | 國立中正大學學生會')
            ->image(asset('assets/media/images/general/guide/cooperative-store.jpg'));

        return view('cooperative-stores.index', compact('groups', 'css'));
    }

    /**
     * 分類會刊群組，用於首頁的分類頁籤.
     *
     * @return array
     */
    protected function classify()
    {
        return CooperativeStore::groupBy(['group'])
            // 過濾已結束的特約商店
            ->active()
            // 過濾未發布的特約商店
            ->published()
            ->get(['group'])
            // 只需要 group 的值，否則會是 Eloquent Model
            ->map(function (CooperativeStore $store) {
                return $store->getAttribute('group');
            })
            // 群組格式為 parent-children
            // 將以 parent 做 groupBy
            ->groupBy(function ($group) {
                return array_first(explode('-', $group));
            })
            ->toArray();
    }

    /**
     * 特約商店管理頁面.
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function manage(Request $request)
    {
        $css = new CooperativeStore;

        // 如果關鍵字不為空，代表是搜尋的 request
        if ($request->has('keyword')) {
            $css = $css->where('name', 'like', '%'.$request->input('keyword').'%');
        }

        $css = $css->simplePaginate();

        return view('cooperative-stores.manage', compact('css'));
    }

    /**
     * 特約商店新增頁面.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $groups = $this->groups();

        return view('cooperative-stores.create', compact('groups'));
    }
    
    public function profile()
    {
        $groups = $this->groups();
        return view('cooperative-stores.profile', compact('groups'));
    }

    /**
     * 新增特約商店.
     *
     * @param CooperativeStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CooperativeStoreRequest $request)
    {
        $cs = new CooperativeStore;

        $this->save($cs, $request);

        return redirect()->route('cooperative-stores.manage');
    }

    /**
     * 查看特約商店.
     *
     * @param string $cs
     *
     * @return \Illuminate\View\View
     */
    public function show($cs)
    {
        // 取得指定特約商店資訊
        $cs = CooperativeStore::with('media')
            ->findOrFail($this->decodeHashid($cs));

        // 設定 facebook open graph
        $this->og->title($cs->getAttribute('name').' | 國立中正大學學生會特約商店')
            ->image(asset($cs->getFirstMediaUrl('cs-cover')));

        return view('cooperative-stores.show', compact('cs'));
    }

    /**
     * 編輯特約商店.
     *
     * @param string $cs
     *
     * @return \Illuminate\View\View
     */
    public function edit($cs)
    {
        $groups = $this->groups();

        $cs = CooperativeStore::findOrFail($this->decodeHashid($cs));

        return view('cooperative-stores.edit', compact('groups', 'cs'));
    }

    /**
     * 更新特約商店.
     *
     * @param CooperativeStoreRequest $request
     * @param string $cs
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CooperativeStoreRequest $request, $cs)
    {
        $cs = CooperativeStore::findOrFail($this->decodeHashid($cs));

        $this->save($cs, $request);

        return redirect()->route('cooperative-stores.manage');
    }

    /**
     * 將特約商店儲存至資料庫.
     *
     * @param CooperativeStore $cs
     * @param Request $request
     *
     * @return void
     */
    protected function save(CooperativeStore $cs, Request $request)
    {
        $cs->fill($request->only([
            'name', 'began_at', 'ended_at', 'phone', 'address',
            'description', 'business_hours', 'group',
        ]))
            // 如尚未發布，published 設為 null，否則設為當下時間
            ->setAttribute('published_at', $request->input('published') ? Carbon::now() : null)
            ->save();

        foreach (['cover', 'gallery'] as $type) {
            // 如果該類型檔案不為空，則清空原有檔案
            if ($request->hasFile($type)) {
                $cs->clearMediaCollection('cs-'.$type);
            }

            foreach ($request->file($type, []) as $file) {
                $cs->addMedia($file)
                    ->setFileName(Str::random(8).'.'.$file->guessExtension())
                    ->toMediaCollection('cs-'.$type, 'media.cooperative-store');
            }
        }
    }

    /**
     * 刪除特約商店.
     *
     * @param string $cs
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function destroy($cs)
    {
        CooperativeStore::findOrFail($this->decodeHashid($cs))
            ->delete();

        return $this->ok();
    }

    /**
     * 特約商店群組.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function groups()
    {
        return CooperativeStore::groupBy(['group'])
            ->get(['group'])
            ->pluck('group', 'group');
    }
}
