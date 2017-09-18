<?php
namespace App\Http\Controllers;
use App\Models\Recruitmen;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
class RecruitmentController extends Controller
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('role:recruitmen', ['except' => ['index', 'show']]);
    }
    /**
     * 徵才.
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        
        // 設定 facebook open graph
        $this->og->title('2017秋徵 | 國立中正大學學生會')
            ->image(asset('assets/media/images/general/guide/cooperative-store.jpg'));
        //return redirect('/')->setTargetUrl('https://goo.gl/nDQ1rB');
        return view('recruitmen.index', compact(''));
    }


}
