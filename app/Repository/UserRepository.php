<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    private string $model = User::class;

    /**
     * Sucht den Benutzer nach ID oder Returnt 404 Error
     *
     * @param int $id
     * @return User
     */
    public function findById(int $id)
    {
        return User::findOrFail($id);
    }
}
