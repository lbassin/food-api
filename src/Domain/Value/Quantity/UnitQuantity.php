<?php

declare(strict_types=1);

namespace App\Domain\Value\Quantity;

class UnitQuantity implements Quantity
{
    private $units;

    public function __construct(int $units)
    {
        $this->units = $units;
    }

    public function getType(): string
    {
        return 'unit';
    }

    public function getValueAsString(): string
    {
        return (string) $this->units;
    }
}
