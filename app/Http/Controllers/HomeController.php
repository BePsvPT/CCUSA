<?php

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
