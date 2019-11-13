<?php

declare(strict_types=1);

namespace App\Domain\Exception\Value;

use Throwable;

class PortionQuantityNotValidException extends \RuntimeException
{
    public function __construct(int $portion, Throwable $previous = null)
    {
        $message = sprintf('Portion should be a number between 1 and 10, %d provided', $portion);

        parent::__construct($message, 1, $previous);
    }
}
