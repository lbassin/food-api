<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Ingredient;
use App\Domain\Entity\RecipeStep;

interface IngredientQuantityRepositoryInterface
{
    public function addIngredientToStep(RecipeStep $step, Ingredient $ingredient, int $unit);
}
