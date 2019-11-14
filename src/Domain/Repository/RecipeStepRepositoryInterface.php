<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Recipe;
use App\Domain\Entity\RecipeStep;

interface RecipeStepRepositoryInterface
{
    public function createStepForRecipe(Recipe $recipe, string $instruction): RecipeStep;
}
