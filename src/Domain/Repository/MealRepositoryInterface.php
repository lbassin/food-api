<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Day;
use App\Domain\Entity\Meal;

interface MealRepositoryInterface
{
    public function createAndSaveAllMealsForDay(Day $day): void;

    public function getOneByDayAndPosition(Day $day, int $position): Meal;
}
