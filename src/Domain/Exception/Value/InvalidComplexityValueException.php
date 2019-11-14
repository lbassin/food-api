<?php

declare(strict_types=1);

namespace App\Domain\Exception\Value;

use App\Domain\Exception\ExceptionTypes;
use Throwable;

class InvalidComplexityValueException extends \RuntimeException
{
    public function __construct(int $complexity, Throwable $previous = null)
    {
        $message = sprintf('Complexity should have a value between 0 and 5, %s provided', $complexity);

        parent::__construct($message, ExceptionTypes::DOMAIN, $previous);
    }

}
