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
        return view('profile.index');
    }
}
