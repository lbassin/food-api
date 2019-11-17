<?php

declare(strict_types=1);

namespace App\Infrastructure\Fixtures;

use App\Domain\Repository\IngredientQuantityRepositoryInterface;
use App\Domain\Repository\IngredientRepositoryInterface;
use App\Domain\Repository\RecipeRepositoryInterface;
use App\Domain\Repository\RecipeStepRepositoryInterface;
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
        $recipe = $this->recipeRepository->createDraft('Buritos', 2, 25, 1);

        [$tomato, $salad, $onion] = $this->getIngredients();

        $step = $this->recipeStepRepository->createStepForRecipe($recipe, 'Buy things');

        $this->ingredientQuantityRepository->addIngredientToStep($step, $tomato, 2);
        $this->ingredientQuantityRepository->addIngredientToStep($step, $salad, 1);
        $this->ingredientQuantityRepository->addIngredientToStep($step, $onion, 125);

        $recipe->addStep($step);

        $recipe->publish();

        $this->recipeRepository->save($recipe);

        // ---

        $recipe = $this->recipeRepository->createDraft('Sushis', 2, 45, 3);
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
