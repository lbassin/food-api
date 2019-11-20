<?php

declare(strict_types=1);

namespace App\Domain\Exception\Value;

use App\Domain\Exception\ExceptionTypes;
use Throwable;

class RawPasswordShouldHaveNoHashProvidedException extends \RuntimeException
{
    public function __construct(Throwable $previous = null)
    {
        $message = 'A password should not have a raw value and a hash provided at the same time';

        parent::__construct($message, ExceptionTypes::DOMAIN, $previous);
    }
}
