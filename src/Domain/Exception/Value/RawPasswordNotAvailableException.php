<?php

declare(strict_types=1);

namespace App\Domain\Exception\Value;

use App\Domain\Exception\ExceptionTypes;
use Throwable;

class RawPasswordNotAvailableException extends \RuntimeException
{
    public function __construct(Throwable $previous = null)
    {
        $message = 'Raw password is not available';

        parent::__construct($message, ExceptionTypes::DOMAIN, $previous);
    }
}
