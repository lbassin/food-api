<?php

declare(strict_types=1);

namespace App\Domain\Value;

use App\Domain\Exception\Value\DurationShouldBePositiveException;

class Duration
{
    private $value;

    public function __construct(int $duration)
    {
        if ($duration < 0) {
            throw new DurationShouldBePositiveException($duration);
        }

        $this->value = $duration;
    }

    public function getMinutes(): int
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string) $this->getMinutes();
    }
}
