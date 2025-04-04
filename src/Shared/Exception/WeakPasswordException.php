<?php

namespace App\Shared\Exception;

class WeakPasswordException extends \InvalidArgumentException
{
    public function __construct(string $message = "Weak password", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
