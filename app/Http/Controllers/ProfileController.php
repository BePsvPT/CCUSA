<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    /**
     * 學生會簡介.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->og->image(asset('assets/media/images/general/logo/ccusa.png'));

        return view('profile.index');
    }
}
