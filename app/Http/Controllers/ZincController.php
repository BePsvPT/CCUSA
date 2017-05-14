<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZincRequest;
use App\Models\Zinc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ZincController extends Controller
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        // 除了 index 和 show 頁面外，皆需有會刊管理權限
        $this->middleware('role:zinc', ['except' => ['index', 'show', 'redirect']]);
    }

    /**
     * 會刊首頁.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 取得已發布的會刊，並按造年月排序，一頁六筆資料
        $zincs = Zinc::with(['media'])
            ->whereNotNull('published_at')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->simplePaginate(6);

        // 設定 facebook open graph
        $this->og->title('ZINE | 國立中正大學學生會')
            ->image(asset('assets/media/images/general/guide/zinc.png'));

        return view('zinc.index', compact('zincs'));
    }

    /**
     * 會刊管理頁面.
     *
     * @return \Illuminate\View\View
     */
    public function manage()
    {
        // 取得所有會刊，並按造年月排序，一頁十筆資料
        $zincs = Zinc::orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->simplePaginate();

        return view('zinc.manage', compact('zincs'));
    }

    /**
     * 會刊新增頁面.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('zinc.create');
    }

    /**
     * 新增會刊.
     *
     * @param ZincRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ZincRequest $request)
    {
        $this->save(new Zinc, $request);

        return redirect()->route('zinc.manage');
    }

    /**
     * 查看會刊.
     *
     * @param Request $request
     * @param int $year
     * @param int $month
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $year, $month)
    {
        // 取得指定月份會刊
        $zinc = Zinc::with(['media'])
            ->where('year', $year)
            ->where('month', $month)
            ->firstOrFail();

        // 如尚未發布且未登入，則回傳 404
        if (is_null($zinc->getAttribute('published_at')) && is_null($request->user())) {
            throw new NotFoundHttpException;
        }

        // 設定 facebook open graph
        $this->og->title($zinc->getAttribute('topic').' | 國立中正大學學生會會刊')
            ->image(asset($zinc->getFirstMediaUrl('zinc')));

        return view('zinc.show', compact('zinc'));
    }

    /**
     * 編輯會刊.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $zinc = Zinc::with(['media'])->findOrFail($id);

        return view('zinc.edit', compact('zinc'));
    }

    /**
     * 更新會刊.
     *
     * @param ZincRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ZincRequest $request, $id)
    {
        $this->save(Zinc::findOrFail($id), $request);

        return redirect()->route('zinc.manage');
    }

    /**
     * 將會刊儲存至資料庫.
     *
     * @param Zinc $zinc
     * @param Request $request
     *
     * @return void
     */
    protected function save(Zinc $zinc, Request $request)
    {
        $zinc->fill($request->only(['year', 'month', 'topic']))
            // 如尚未發布，published_at 設為 null，否則設為當下時間
            ->setAttribute('published_at', $request->input('published') ? Carbon::now() : null)
            ->save();

        // 上傳圖片
        foreach ($request->file('image', []) as $file) {
            $zinc->addMedia($file)
                ->toMediaCollection('zinc', 'media.zinc');
        }
    }

    /**
     * 刪除會刊.
     *
     * @param int $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        Zinc::findOrFail($id)->delete();

        return $this->ok();
    }

    /**
     * 重新導向會刊網址.
     *
     * @param string $url
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect($url = '')
    {
        $url = '/zine'.('' === $url ? '' : "/{$url}");

        return redirect($url, 301);
    }
}
