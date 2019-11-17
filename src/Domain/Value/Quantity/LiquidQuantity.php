<?php

declare(strict_types=1);

namespace App\Domain\Value\Quantity;

class LiquidQuantity implements Quantity
{
    private $liquid;

    public function __construct(int $liquid)
    {
        $this->liquid = $liquid;
    }

    public function getType(): string
    {
        return 'liquid';
    }

    public function getValueAsString(): string
    {
        return (string) $this->liquid;
    }
}
