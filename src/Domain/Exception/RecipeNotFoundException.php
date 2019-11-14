<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Ramsey\Uuid\UuidInterface;
use Throwable;

class RecipeNotFoundException extends \RuntimeException
{
    public function __construct(UuidInterface $uuid, Throwable $previous = null)
    {
        $message = sprintf('Recipe not found (%s)', $uuid);

        parent::__construct($message, 1, $previous);
    }
}
