<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    /**
     * 學生會首頁.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('profile.index');
    }
}
