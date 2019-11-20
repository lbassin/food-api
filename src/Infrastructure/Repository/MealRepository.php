<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Meal;
use App\Domain\Repository\MealRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class MealRepository implements MealRepositoryInterface
{
    private $entityManager;

    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Meal::class);
    }
}
