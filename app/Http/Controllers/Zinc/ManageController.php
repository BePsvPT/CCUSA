<?php

namespace App\Http\Controllers\Zinc;

use Analytics;
use App\Zinc\Zinc;
use App\Http\Controllers\Controller;
use App\Http\Requests\ZincRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ManageController extends Controller
{
    /**
     * Get the zinc manage page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $zincs = Zinc::orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->simplePaginate();

        return view('zinc.manage.index', compact('zincs'));
    }

    /**
     * Get the zinc create page.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('zinc.manage.create');
    }

    /**
     * Create a new zinc.
     *
     * @param ZincRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ZincRequest $request)
    {
        $zinc = Zinc::create(
            array_merge($request->only(['year', 'month', 'topic']), $this->getPublished($request))
        );

        foreach ($request->file('image', []) as $file) {
            $zinc->addMedia($file)
                ->setFileName(Str::quickRandom(8).'.'.$file->guessExtension())
                ->toCollection('images-zinc', 'media.zinc');
        }

        return redirect()->route('zinc.manage.index');
    }

    /**
     * Get the zinc edit page.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $zinc = Zinc::with(['media'])->findOrFail($id);

        return view('zinc.manage.edit', compact('zinc'));
    }

    /**
     * Update the zinc.
     *
     * @param ZincRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ZincRequest $request, $id)
    {
        Zinc::findOrFail($id)->update(
            array_merge($request->only(['year', 'month', 'topic']), $this->getPublished($request))
        );

        return redirect()->route('zinc.manage.index');
    }

    /**
     * Get published data.
     *
     * @param Request $request
     *
     * @return array
     */
    protected function getPublished(Request $request)
    {
        $published = boolval($request->input('published'));

        return [
            'published' => $published,
            'published_at' => $published ? Carbon::now() : null,
        ];
    }

    /**
     * Delete the specific zinc.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        Zinc::findOrFail($id)->delete();

        return $this->ok();
    }

    /**
     * Get google analytics page.
     *
     * @return \Illuminate\View\View
     */
    public function analytics()
    {
        return view('zinc.manage.analytics');
    }

    /**
     * Get the google analytics data.
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
