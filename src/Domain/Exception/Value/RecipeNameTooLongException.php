<?php

declare(strict_types=1);

namespace App\Domain\Exception\Value;

use Throwable;

class RecipeNameTooLongException extends \RuntimeException
{
    public function __construct(string $name, Throwable $previous = null)
    {
        $message = sprintf('Recipe name too long (%s)', $name);

        parent::__construct($message, 1, $previous);
    }
}
