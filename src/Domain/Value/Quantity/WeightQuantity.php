<?php

declare(strict_types=1);

namespace App\Domain\Value\Quantity;

class WeightQuantity implements Quantity
{
    private $weight;

    public function __construct(int $weight)
    {
        $this->weight = $weight;
    }

    public function getType(): string
    {
        return 'weight';
    }

    public function getValueAsString(): string
    {
        return (string) $this->weight;
    }
}
