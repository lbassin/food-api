<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Calendar;
use App\Domain\Entity\User;
use App\Domain\Exception\CalendarNotFoundException;
use App\Domain\Repository\CalendarRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class CalendarRepository implements CalendarRepositoryInterface
{
    private $entityManager;

    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Calendar::class);
    }

    public function createCalendarForUser(User $user): Calendar
    {
        return new Calendar(
            $this->nextIdentity(),
            $user
        );
    }

    public function save(Calendar $calendar): void
    {
        $this->entityManager->persist($calendar);
        $this->entityManager->flush();
    }

    public function getById(UuidInterface $id): Calendar
    {
        /** @var Calendar $calendar */
        $calendar = $this->repository->findOneBy(['id' => $id->toString()]);
        if (!$calendar) {
            throw new CalendarNotFoundException($id);
        }

        return $calendar;
    }

    private function nextIdentity(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
