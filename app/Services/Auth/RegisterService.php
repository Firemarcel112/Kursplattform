<?php

namespace App\Services\Auth;

use App\DTO\RegisterUserDTO;
use App\Events\UserRegistered;
use App\Models\User;
use App\Services\EventDispatchService;
use App\Services\UserService;

class RegisterService
{
    protected VerificationLinkGenerator $link_generator;
    protected EventDispatchService $event_dispatcher;
    protected UserService $user_service;

    public function __construct(
        VerificationLinkGenerator $link_generator,
        EventDispatchService $event_dispatcher,
        UserService $user_service
    ) {
        $this->link_generator = $link_generator;
        $this->event_dispatcher = $event_dispatcher;
        $this->user_service = $user_service;
    }

    /**
     * Registriert einen neuen Benutzer
     *
     * @param RegisterUserDTO $data
     * @return User
     */
    public function register(RegisterUserDTO $data): User
    {
        $user = $this->user_service->createOne($data);

        $url = $this->link_generator->forUser($user->id, 'verify.email');

        $this->event_dispatcher->dispatch(new UserRegistered($user, $url));

        return $user;
    }
}
