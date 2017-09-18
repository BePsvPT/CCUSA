<?php
/*namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
class RecruitmentController extends Controller
{

    /**
     * 徵才.
     * @return \Illuminate\View\View
     */
    /*public function index()
    {
        
        // 設定 facebook open graph
        $this->og->title('2017秋徵 | 國立中正大學學生會')
            ->image(asset('assets/media/images/general/guide/cooperative-store.jpg'));
        //return redirect('/')->setTargetUrl('https://goo.gl/nDQ1rB');
        return view('recruitment.index');
    }


}*/
namespace App\Http\Controllers;
class HomeController extends Controller
{
    /**
     * 學生會首頁.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        $this->og->image(asset('assets/media/images/general/logo/ccusa.png'));
        return view('home');
    }
}
