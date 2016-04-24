<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

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
    
    /**
     * 文件下載首頁
     */
    public function document()
    {
        //
    }
}
