<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Ramsey\Uuid\UuidInterface;

class Day
{
    private $id;

    private $calendar;

    private $position;

    private $meals;

    public function __construct(UuidInterface $id, Calendar $calendar, int $position)
    {
        $this->id = $id;
        $this->calendar = $calendar;
        $this->position = $position;
    }
}
