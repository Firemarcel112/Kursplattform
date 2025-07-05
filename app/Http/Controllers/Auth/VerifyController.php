<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\UserRepository;
use App\Services\AlertService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class VerifyController extends Controller
{
    public function __construct(
        public AlertService $alert,
        public UserRepository $user_repository
    ) {
        $this->alert = $alert;
        $this->user_repository = $user_repository;
    }

    /**
     * Verifiziert die E-Mail-Adresse eines Benutzers
     *
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function email(Request $request, int $id)
    {
        if (! URL::hasValidSignature($request)) {
            abort(401);
        }

        try {
            $user = $this->user_repository->findById($id);
        } catch (ModelNotFoundException $e) {
            abort(403);
        }

        if ($user->hasVerifiedEmail()) {
            $this->alert->info(__('verification.email_already_verified'));
            return redirect()->route('home');
        }

        if ($user->markEmailAsVerified()) {
            $this->alert->success(__('verification.email_verify_success'));
        };
        return redirect()->route('home');
    }
}
