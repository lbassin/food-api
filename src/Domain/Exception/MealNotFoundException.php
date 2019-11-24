<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Ramsey\Uuid\UuidInterface;
use Throwable;

class MealNotFoundException extends \RuntimeException
{
    public function __construct(UuidInterface $id, int $position, Throwable $previous = null)
    {
        $message = sprintf('Meal not found (%s;%s)', $id, $position);

        parent::__construct($message, ExceptionTypes::NOT_FOUND, $previous);
    }
}
