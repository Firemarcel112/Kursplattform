<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\AlertService;
use App\Services\Auth\RegisterService;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.register');
    }

    /**
     * Registrierung für einen neuen Benutzer
     *
     * @param RegisterRequest $request
     * @param RegisterService $register_service
     * @param AlertService $alert
     * @return mixed
     */
    public function store(
        RegisterRequest $request,
        RegisterService $register_service,
        AlertService $alert
    ) {
        $user = $register_service->register($request->toDTO());

        Auth::login($user);

        $alert->success(__('auth.register_success', ['name' => $user->name]));

        return redirect()
            ->route('home');
    }
}
