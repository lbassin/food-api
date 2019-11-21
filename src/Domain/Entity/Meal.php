<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Ramsey\Uuid\UuidInterface;

class Meal
{
    private $id;

    private $day;

    private $position;

    private $recipe;

    private $portion;

    public function __construct(UuidInterface $id, Day $day, int $position)
    {
        $this->id = $id;
        $this->day = $day;
        $this->position = $position;
        $this->recipe = null;
        $this->portion = null;
    }
}
