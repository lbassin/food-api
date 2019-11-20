<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Day;
use App\Domain\Repository\DayRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class DayRepository implements DayRepositoryInterface
{
    private $entityManager;

    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Day::class);
    }
}
