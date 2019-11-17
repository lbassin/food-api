<?php

declare(strict_types=1);

namespace App\Domain\Value\Quantity;

interface Quantity
{
    public function getType(): string;

    public function getValueAsString    (): string;
}
