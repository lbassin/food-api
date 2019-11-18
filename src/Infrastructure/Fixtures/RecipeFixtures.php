<?php

declare(strict_types=1);

namespace App\Infrastructure\Fixtures;

use App\Domain\Repository\IngredientQuantityRepositoryInterface;
use App\Domain\Repository\IngredientRepositoryInterface;
use App\Domain\Repository\RecipeRepositoryInterface;
use App\Domain\Repository\RecipeStepRepositoryInterface;
use App\Domain\Value\Quantity\UnitQuantity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RecipeFixtures extends Fixture implements DependentFixtureInterface
{

    private $recipeRepository;
    private $recipeStepRepository;
    private $ingredientRepository;
    private $ingredientQuantityRepository;

    public function __construct(
        RecipeRepositoryInterface $recipeRepository,
        RecipeStepRepositoryInterface $recipeStepRepository,
        IngredientRepositoryInterface $ingredientRepository,
        IngredientQuantityRepositoryInterface $ingredientQuantityRepository
    ) {
        $this->recipeRepository = $recipeRepository;
        $this->recipeStepRepository = $recipeStepRepository;
        $this->ingredientRepository = $ingredientRepository;
        $this->ingredientQuantityRepository = $ingredientQuantityRepository;
    }

    public function load(ObjectManager $manager)
    {
        $this->createBuritosRecipe();
        $this->createSushisRecipe();
        $this->createPizzaRecipe();
    }

    private function createBuritosRecipe(): void
    {
        $recipe = $this->recipeRepository->createDraft('Buritos', 2, 25, 1);

        [$tomato, $salad, $onion] = $this->getIngredients();

        $step = $this->recipeStepRepository->createStepForRecipe($recipe, 'Buy things');
        $this->ingredientQuantityRepository->addIngredientToStep($step, $tomato, new UnitQuantity(2));
        $recipe->addStep($step);

        $step = $this->recipeStepRepository->createStepForRecipe($recipe, 'Cook it');
        $this->ingredientQuantityRepository->addIngredientToStep($step, $salad, new UnitQuantity(1));
        $this->ingredientQuantityRepository->addIngredientToStep($step, $onion, new UnitQuantity(3));
        $recipe->addStep($step);

        $recipe->publish();
        $this->recipeRepository->save($recipe);
    }

    private function createSushisRecipe(): void
    {
        $recipe = $this->recipeRepository->createDraft('Sushis', 2, 45, 3);
        $this->recipeRepository->save($recipe);
    }

    private function createPizzaRecipe(): void
    {
        $recipe = $this->recipeRepository->createDraft('Pizza', 2, 25, 1);

        [$tomato, $salad, $onion] = $this->getIngredients();

        $step = $this->recipeStepRepository->createStepForRecipe($recipe, 'Buy things');
        $this->ingredientQuantityRepository->addIngredientToStep($step, $tomato, new UnitQuantity(2));
        $recipe->addStep($step);

        $step = $this->recipeStepRepository->createStepForRecipe($recipe, 'Cook it');
        $this->ingredientQuantityRepository->addIngredientToStep($step, $salad, new UnitQuantity(1));
        $this->ingredientQuantityRepository->addIngredientToStep($step, $onion, new UnitQuantity(3));
        $recipe->addStep($step);

        $step = $this->recipeStepRepository->createStepForRecipe($recipe, 'Eat it');
        $recipe->addStep($step);

        $recipe->publish();
        $this->recipeRepository->save($recipe);
    }

    private function getIngredients(): array
    {
        return [
            $this->getReference('ingredient_tomato'),
            $this->getReference('ingredient_salad'),
            $this->getReference('ingredient_onion'),
        ];
    }

    public function getDependencies(): array
    {
        return [
            IngredientFixtures::class,
        ];
    }
}
