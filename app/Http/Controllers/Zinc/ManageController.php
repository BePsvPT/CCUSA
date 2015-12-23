<?php

namespace App\Http\Controllers\Zinc;

use Analytics;
use App\Ccusa\Zinc;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ManageController extends Controller
{
    /**
     * 會刊管理頁面
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $zincs = Zinc::orderBy('year', 'desc')->orderBy('month', 'desc')->simplePaginate(10);

        return view('zinc.manage.index', compact('zincs'));
    }

    /**
     * 新增會刊
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('zinc.manage.create');
    }

    /**
     * 創見會刊
     *
     * @param Requests\ZincRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Requests\ZincRequest $request)
    {
        $zinc = Zinc::create(array_merge($request->only(['year', 'month', 'topic']), [
            'published' => $published = $request->input('published', false),
            'published_at' => $published ? Carbon::now() : null,
        ]));

        foreach ($request->file('image', []) as $file) {
            $zinc->addMedia($file)
                ->setFileName(str_random(8) . '.' . $file->guessExtension())
                ->toCollection('images-zinc', 'media.zinc');
        }

        return redirect()->route('zinc.manage.index');
    }

    /**
     * 編輯會刊
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $zinc = Zinc::with(['media'])->findOrFail($id);

        return view('zinc.manage.edit', compact('zinc'));
    }

    /**
     * 更新會刊
     *
     * @param Requests\ZincRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Requests\ZincRequest $request, $id)
    {
        Zinc::findOrFail($id)->update(array_merge($request->only(['year', 'month', 'topic']), [
            'published' => $published = $request->input('published', false),
            'published_at' => $published ? Carbon::now() : null,
        ]));

        return redirect()->route('zinc.manage.index');
    }

    /**
     * 刪除會刊
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        Zinc::findOrFail($id)->delete();

        return $this->ok();
    }

    /**
     * Google Analytics 頁面
     *
     * @return \Illuminate\View\View
     */
    public function analytics()
    {
        return view('zinc.manage.analytics');
    }

    /**
     * Google Analytics Data
     *
     * @return array
     */
    public function analyticsData()
    {
        $analytics = ['date' => [], 'visitors' => [], 'pageViews' => []];

        foreach (Analytics::getVisitorsAndPageViews(30) as $data) {
            $analytics['date'][] = $data['date']->format('m-d');
            $analytics['visitors'][] = $data['visitors'];
            $analytics['pageViews'][] = $data['pageViews'];
        }

        return $analytics;
    }
}
