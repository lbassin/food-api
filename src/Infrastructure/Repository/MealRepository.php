<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Day;
use App\Domain\Entity\Meal;
use App\Domain\Repository\MealRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class MealRepository implements MealRepositoryInterface
{
    private $entityManager;

    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Meal::class);
    }

    public function createAndSaveAllMealsForDay(Day $day): void
    {
        foreach (range(0, 1) as $index) {
            $meal = new Meal(
                $this->nextIdentity(),
                $day,
                $index
            );

            $this->entityManager->persist($meal);
        }

        $this->entityManager->flush();
    }

    private function nextIdentity(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
