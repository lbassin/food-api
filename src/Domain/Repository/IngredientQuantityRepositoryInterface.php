<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Ingredient;
use App\Domain\Entity\RecipeStep;
use App\Domain\Value\Quantity\Quantity;

interface IngredientQuantityRepositoryInterface
{
    public function addIngredientToStep(RecipeStep $step, Ingredient $ingredient, Quantity $quantity);
}
