<?php

namespace App\DTO;

class RegisterUserDTO
{

    /**
     * Data Transfer Object für die Registrierung eines Benutzers.
     *
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
