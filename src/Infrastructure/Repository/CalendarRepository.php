<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Calendar;
use App\Domain\Repository\CalendarRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class CalendarRepository implements CalendarRepositoryInterface
{
    private $entityManager;

    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Calendar::class);
    }
}
