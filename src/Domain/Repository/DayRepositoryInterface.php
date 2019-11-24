<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Calendar;
use App\Domain\Entity\Day;
use App\Domain\Entity\User;
use App\Domain\Exception\DayNotFoundException;

interface DayRepositoryInterface
{
    public function createAndSaveAllDaysForCalendar(Calendar $calendar): void;

    /** @throws DayNotFoundException */
    public function getOneByUserAndPosition(User $user, int $position): Day;
}
