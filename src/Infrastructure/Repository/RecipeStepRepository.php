<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Recipe;
use App\Domain\Entity\RecipeStep;
use App\Domain\Repository\RecipeStepRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class RecipeStepRepository implements RecipeStepRepositoryInterface
{

    private $entityManager;
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(RecipeStep::class);
    }

    public function createStepForRecipe(Recipe $recipe, string $instruction): RecipeStep
    {
        $position = 0;
        if (count($recipe->getSteps()) > 0) {
            $steps = $recipe->getSteps();
            $position = end($steps)->getPosition() + 1;
        }

        $recipeStep = new RecipeStep($this->nextIdentity(), $position, $instruction, $recipe);

        $this->entityManager->persist($recipeStep);

        return $recipeStep;
    }

    private function nextIdentity(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
