<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Sign in page.
     *
     * @return mixed
     */
    public function signIn()
    {
        return view('auth.sign-in');
    }
    
    /**
     * Auth the sign in request.
     *
     * @param Request $request
     * @return mixed
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
     * @return mixed
     */
    public function signOut()
    {
        Auth::logout();

        return redirect()->home();
    }
}