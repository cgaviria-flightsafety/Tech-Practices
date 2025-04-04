<?php

namespace App\Shared\Exception;

class InvalidEmailException extends \InvalidArgumentException
{
    public function __construct(string $message = "Invalid email format", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
