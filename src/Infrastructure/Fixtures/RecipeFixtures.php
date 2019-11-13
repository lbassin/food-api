<?php

declare(strict_types=1);

namespace App\Infrastructure\Fixtures;

use App\Domain\Repository\RecipeRepositoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RecipeFixtures extends Fixture
{

    private $recipeRepository;

    public function __construct(RecipeRepositoryInterface $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function load(ObjectManager $manager)
    {
        $recipe = $this->recipeRepository->createDraft('Buritos', 2, 25, 1);
        $this->recipeRepository->save($recipe);
    }
}
