<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Value\Quantity\Quantity;
use Ramsey\Uuid\UuidInterface;

class IngredientQuantity
{
    private $id;

    private $ingredient;

    private $step;

    private $quantity;

    public function __construct(UuidInterface $id, Ingredient $ingredient, RecipeStep $step, Quantity $quantity)
    {
        $this->id = $id;
        $this->ingredient = $ingredient;
        $this->step = $step;
        $this->quantity = $quantity;
    }

    public function getIngredient(): Ingredient
    {
        return $this->ingredient;
    }

    public function getQuantity(): Quantity
    {
        return $this->quantity;
    }
}
