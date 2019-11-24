<?php

declare(strict_types=1);

namespace App\Domain\Exception\User;

use App\Domain\Exception\ExceptionTypes;
use Throwable;

class PasswordTooShortException extends \RuntimeException
{
    public function __construct(Throwable $previous = null)
    {
        $message = 'Password too short';

        parent::__construct($message, ExceptionTypes::DOMAIN, $previous);
    }
}
