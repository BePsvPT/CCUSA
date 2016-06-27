<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class HomeController extends Controller
{
    /**
     * Get the application home page.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        return view('home');
    }
}
