<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * 登入頁面.
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function signIn(Request $request)
    {
        if (! is_null($request->user())) {
            return redirect()->home();
        }

        $this->og->title('登入 | 國立中正大學學生會');

        return view('auth.sign-in');
    }

    /**
     * 登入.
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
     * 登出.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signOut(Request $request)
    {
        Auth::logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->home();
    }
}
