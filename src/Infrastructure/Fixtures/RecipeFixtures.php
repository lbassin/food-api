<?php

declare(strict_types=1);

namespace App\Infrastructure\Fixtures;

use App\Domain\Entity\IngredientQuantity;
use App\Domain\Repository\IngredientRepositoryInterface;
use App\Domain\Repository\RecipeRepositoryInterface;
use App\Domain\Repository\RecipeStepRepositoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class RecipeFixtures extends Fixture
{

    private $recipeRepository;
    private $recipeStepRepository;
    private $ingredientRepository;

    public function __construct(
        RecipeRepositoryInterface $recipeRepository,
        RecipeStepRepositoryInterface $recipeStepRepository,
        IngredientRepositoryInterface $ingredientRepository
    ) {
        $this->recipeRepository = $recipeRepository;
        $this->recipeStepRepository = $recipeStepRepository;
        $this->ingredientRepository = $ingredientRepository;
    }

    public function load(ObjectManager $manager)
    {
        $recipe = $this->recipeRepository->createDraft('Buritos', 2, 25, 1);
        $this->recipeRepository->save($recipe);

        $step = $this->recipeStepRepository->createStepForRecipe($recipe, 'Buy things');
        //$ingredient = $this->ingredientRepository->getById([...]);
        //$this->ingredientQuantityRepository->addIngredientToStep($step, $ingredient, 40);
        $recipe->addStep($step);

        $recipe->addStep($this->recipeStepRepository->createStepForRecipe($recipe, 'Cook it'));
        $recipe->addStep($this->recipeStepRepository->createStepForRecipe($recipe, 'Eat it'));

        $recipe->publish();

        $this->recipeRepository->save($recipe);

        // ---

        $recipe = $this->recipeRepository->createDraft('Pizza', 1, 70, 3);
        $recipe->addStep($this->recipeStepRepository->createStepForRecipe($recipe, 'Do nothing'));

        $recipe->publish();

        $this->recipeRepository->save($recipe);

        // ---

        $recipe = $this->recipeRepository->createDraft('Sushis', 2, 45, 3);
        $this->recipeRepository->save($recipe);
    }
}
