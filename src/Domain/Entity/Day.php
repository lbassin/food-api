<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

class Day
{
    private $id;

    private $calendar;

    private $position;

    /** @var ArrayCollection */
    private $meals;

    public function __construct(UuidInterface $id, Calendar $calendar, int $position)
    {
        $this->id = $id;
        $this->calendar = $calendar;
        $this->position = $position;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function getMeals(): array
    {
        return $this->meals->toArray();
    }
}
