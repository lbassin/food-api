<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Ramsey\Uuid\UuidInterface;
use Throwable;

class CalendarNotFoundException extends \RuntimeException
{
    public function __construct(UuidInterface $id, Throwable $previous = null)
    {
        $message = sprintf('Calendar not found (%s)', $id);

        parent::__construct($message, ExceptionTypes::NOT_FOUND, $previous);
    }
}
