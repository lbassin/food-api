<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Throwable;

class UserAlreadyExistsException extends \RuntimeException
{
    public function __construct(string $email, Throwable $previous = null)
    {
        $message = sprintf('User already exists (%s)', $email);

        parent::__construct($message, ExceptionTypes::DOMAIN, $previous);
    }
}
