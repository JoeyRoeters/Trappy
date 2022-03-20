<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class AuthController extends Controller
{
    /**
     * @return Application|Redirector
     */
    public function showPage(): Redirector|Application
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('templates/auth/login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse|Redirector
     */
    public function login(LoginRequest $request): Redirector|Application
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors(['failed' => __('auth.failed')]);
    }

    /**
     * @param Request $request
     * @return Redirector
     */
    public function logout(Request $request): Redirector
    {
        $request->session()->invalidate();

        return redirect('/login');
    }
}
