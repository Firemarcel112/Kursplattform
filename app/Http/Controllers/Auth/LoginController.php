<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AlertService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct(
        public AlertService $alert
    ) {
        $this->middleware('guest')
            ->except('logout');
    }

    /**
     * Zeigt die Login-Seite an
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Loggt den Benutzzer ein
     * @param \App\Http\Requests\LoginRequest $request
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $this->alert->success(__('auth.login_success', ['name' => Auth::user()->display_name]));
            return redirect()->intended('');
        }

        $this->alert->error(__('auth.login_failed'));

        return back()->withInput($request->only('name'));
    }

    /**
     * Loggt den Benutzer aus
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        session()->invalidate();
        session()->regenerateToken();
        Auth::logout();

        $this->alert->success(__('auth.logout_success'));

        return redirect()->route('home');
    }
}
