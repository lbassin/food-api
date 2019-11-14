<?php

declare(strict_types=1);

namespace App\Domain\Exception\Value;

use App\Domain\Exception\ExceptionTypes;
use Throwable;

class DurationShouldBePositiveException extends \RuntimeException
{
    public function __construct(int $duration, Throwable $previous = null)
    {
        $message = sprintf('Duration should be greater than zero, %d provided', $duration);

        parent::__construct($message, ExceptionTypes::DOMAIN, $previous);
    }
}
