<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class HomeController extends Controller
{
    /**
     * 網站首頁
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        return view('home');
    }
}
