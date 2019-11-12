<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Recipe;
use App\Domain\Repository\RecipeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class RecipeRepository implements RecipeRepositoryInterface
{

    private $entityManager;

    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Recipe::class);
    }

    public function getAllNoneDraft(): array
    {
        return $this->repository->findBy([
            'draft' => 0,
        ]);
    }
}
