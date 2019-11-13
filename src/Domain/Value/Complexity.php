<?php

declare(strict_types=1);

namespace App\Domain\Value;

use App\Domain\Exception\Value\InvalidComplexityValueException;

class Complexity
{
    private $value;

    public function __construct(int $complexity)
    {
        if ($complexity < 0 || $complexity > 5) {
            throw new InvalidComplexityValueException($complexity);
        }

        $this->value = $complexity;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}
