<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Ingredient;
use App\Domain\Entity\IngredientQuantity;
use App\Domain\Entity\RecipeStep;
use App\Domain\Repository\IngredientQuantityRepositoryInterface;
use App\Domain\Value\Quantity\Quantity;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class IngredientQuantityRepository implements IngredientQuantityRepositoryInterface
{
    private $entityManager;

    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Ingredient::class);
    }

    public function addIngredientToStep(RecipeStep $step, Ingredient $ingredient, Quantity $quantity)
    {
        $ingredientQuantity = new IngredientQuantity(
            $this->nextIdentity(),
            $ingredient,
            $step,
            $quantity
        );

        $this->entityManager->persist($ingredientQuantity);
    }

    private function nextIdentity(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
