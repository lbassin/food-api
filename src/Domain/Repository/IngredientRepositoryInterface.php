<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Ingredient;

interface IngredientRepositoryInterface
{
    public function createIngredient(string $name): Ingredient;

    public function save(Ingredient $ingredient): void;
}
