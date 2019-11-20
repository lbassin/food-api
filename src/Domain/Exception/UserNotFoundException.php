<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Throwable;

class UserNotFoundException extends \RuntimeException
{
    public function __construct(string $email, Throwable $previous = null)
    {
        $message = sprintf('User not found (%s)', $email);

        parent::__construct($message, ExceptionTypes::NOT_FOUND, $previous);
    }
}
