<?php

declare(strict_types=1);

namespace App\Domain\Repository;

Interface RecipeRepositoryInterface
{
    public function getAll(): array;
}
