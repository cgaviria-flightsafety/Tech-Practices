<?php

namespace App\Domain\Model\User;

use App\Shared\Exception\WeakPasswordException;

class UserPassword
{
    private string $passwordHash;

    public function __construct(string $password)
    {
        $this->validatePassword($password);
        $this->passwordHash = password_hash($password, PASSWORD_BCRYPT);
    }

    private function validatePassword(string $password): void
    {
        if (
            strlen($password) < 8 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[^A-Za-z0-9]/', $password)
        ) {
            throw new WeakPasswordException('Weak password');
        }
    }

    public function __toString(): string
    {
        return $this->passwordHash;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }
}
