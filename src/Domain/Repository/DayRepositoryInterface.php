<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Calendar;

interface DayRepositoryInterface
{
    public function createAndSaveAllDaysForCalendar(Calendar $calendar): void;
}
