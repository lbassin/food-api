<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Recipe;
use App\Domain\Repository\RecipeRepositoryInterface;
use App\Domain\Value\Complexity;
use App\Domain\Value\Duration;
use App\Domain\Value\Portion;
use App\Domain\Value\RecipeName;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class RecipeRepository implements RecipeRepositoryInterface
{
    private $entityManager;

    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Recipe::class);
    }

    public function createDraft(string $name, int $portion, int $duration, int $complexity): Recipe
    {
        return new Recipe(
            $this->nextIdentity(),
            new RecipeName($name),
            new Portion($portion),
            new Duration($duration),
            new Complexity($complexity)
        );
    }

    public function publish(Recipe $recipe): void
    {
        $recipe->publish();

        $this->entityManager->persist($recipe);
        $this->entityManager->flush();
    }

    public function getAllNoneDraft(): array
    {
        return $this->repository->findBy([
            'draft' => false,
        ]);
    }

    public function save(Recipe $recipe): void
    {
        $this->entityManager->persist($recipe);
        $this->entityManager->flush();
    }

    private function nextIdentity(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
