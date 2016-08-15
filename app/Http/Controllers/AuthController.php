<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{
    /**
     * Get the sign in page.
     *
     * @return \Illuminate\View\View
     */
    public function signIn()
    {
        return view('auth.sign-in');
    }

    /**
     * Sign in to the application.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function auth(Request $request)
    {
        if (! Auth::attempt($request->only(['username', 'password']))) {
            return back()->withErrors(['failed' => trans('auth.failed')]);
        }

        return redirect()->intended(route('home'));
    }

    /**
     * Sign out the application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signOut()
    {
        Auth::logout();

        Session::flush();

        return redirect()->home();
    }
}
