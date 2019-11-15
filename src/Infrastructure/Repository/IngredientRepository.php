<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Ingredient;
use App\Domain\Repository\IngredientRepositoryInterface;
use App\Domain\Value\IngredientName;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class IngredientRepository implements IngredientRepositoryInterface
{
    private $entityManager;

    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Ingredient::class);
    }

    public function createIngredient(string $name): Ingredient
    {
        return new Ingredient(
            $this->nextIdentity(),
            new IngredientName($name)
        );
    }

    public function save(Ingredient $ingredient): void
    {
        $this->entityManager->persist($ingredient);
        $this->entityManager->flush();
    }

    private function nextIdentity(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
