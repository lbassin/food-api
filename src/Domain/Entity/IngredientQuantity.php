<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Ramsey\Uuid\UuidInterface;

class IngredientQuantity
{
    private $id;

    private $ingredient;

    private $step;

    private $quantity;

    public function __construct(UuidInterface $id, Ingredient $ingredient, RecipeStep $step, int $quantity)
    {
        $this->id = $id;
        $this->ingredient = $ingredient;
        $this->step = $step;
        $this->quantity = $quantity;
    }
}
