<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Ingredient;
use App\Domain\Entity\RecipeStep;

interface IngredientRepositoryInterface
{
    public function createIngredient(string $name): Ingredient;

    public function save(Ingredient $ingredient): void;

    public function addIngredientToStep(RecipeStep $step, string $string, int $int);
}
