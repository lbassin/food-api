<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Value\Uuid;

class Recipe
{
    private $id;

    private $name;

    private $portion;

    private $duration;

    private $complexity;

    public function __construct(Uuid $id, string $name, int $portion, int $duration, int $complexity)
    {

    }
}
