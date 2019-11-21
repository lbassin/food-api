<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Day;

interface MealRepositoryInterface
{
    public function createAndSaveAllMealsForDay(Day $day): void;
}
