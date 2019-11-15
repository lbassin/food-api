<?php

declare(strict_types=1);

namespace App\Domain\Value;

use App\Domain\Exception\Value\RecipeNameTooLongException;

class IngredientName
{
    private $value;

    public function __construct(string $name)
    {
        if (strlen($name) > 255) {
            throw new RecipeNameTooLongException($name);
        }

        $this->value = $name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
