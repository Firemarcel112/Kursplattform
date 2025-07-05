<?php

namespace App\Services;

use App\DTO\RegisterUserDTO;
use App\Models\User;

class UserService
{

    /**
     * Erstellt einen neuen Benutzer
     *
     * @param RegisterUserDTO $data
     * @return User
     */
    public function createOne(RegisterUserDTO $data): User
    {
        return User::create($data->toArray());
    }
}
