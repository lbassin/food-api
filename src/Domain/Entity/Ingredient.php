<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Value\IngredientName;
use Ramsey\Uuid\UuidInterface;

class Ingredient
{
    private $id;

    private $name;

    public function __construct(UuidInterface $id, IngredientName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getName(): IngredientName
    {
        return $this->name;
    }
}
