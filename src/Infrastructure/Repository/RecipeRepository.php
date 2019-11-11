<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Repository\RecipeRepositoryInterface;

class RecipeRepository implements RecipeRepositoryInterface
{

    public function getAll(): array
    {
        return [];
    }
}
