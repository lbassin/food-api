<?php

declare(strict_types=1);

namespace App\Domain\Value;

use App\Domain\Exception\Value\PortionQuantityNotValidException;

class Portion
{
    private $value;

    public function __construct(int $portion)
    {
        if ($portion <= 0 || $portion > 10) {
            throw new PortionQuantityNotValidException($portion);
        }

        $this->value = $portion;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->getValue();
    }

}
