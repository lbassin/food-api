<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Calendar;
use App\Domain\Entity\User;
use Ramsey\Uuid\UuidInterface;

interface CalendarRepositoryInterface
{
    public function createCalendarForUser(User $user): Calendar;

    public function save(Calendar $calendar): void;

    public function getById(UuidInterface $id): Calendar;
}
