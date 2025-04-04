<?php

namespace App\Shared\Exception;

class UserAlreadyExistsException extends \InvalidArgumentException
{
    public function __construct(string $message = "User already exists", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
