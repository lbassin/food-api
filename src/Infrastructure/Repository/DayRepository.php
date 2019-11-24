<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Calendar;
use App\Domain\Entity\Day;
use App\Domain\Entity\User;
use App\Domain\Exception\DayNotFoundException;
use App\Domain\Repository\DayRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class DayRepository implements DayRepositoryInterface
{
    private $entityManager;

    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Day::class);
    }

    public function createAndSaveAllDaysForCalendar(Calendar $calendar): void
    {
        foreach (range(0, 6) as $index) {
            $day = new Day(
                $this->nextIdentity(),
                $calendar,
                $index
            );

            $this->entityManager->persist($day);
        }

        $this->entityManager->flush();

        $this->entityManager->refresh($calendar);
    }

    public function getOneByUserAndPosition(User $user, int $position): Day
    {
        /** @var Day $day */
        $day = $this->repository->findOneBy([
            'calendar' => $user->getCalendar(),
            'position' => $position,
        ]);

        if (!$day) {
            throw new DayNotFoundException($user->getCalendar()->getId(), $position);
        }

        return $day;
    }

    private function nextIdentity(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
