<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Throwable;

class InvalidEmailFormatException extends \RuntimeException
{
    public function __construct(string $email, Throwable $previous = null)
    {
        $message = sprintf('Invalid email format provided (%s)', $email);

        parent::__construct($message, ExceptionTypes::DOMAIN, $previous);
    }
}
