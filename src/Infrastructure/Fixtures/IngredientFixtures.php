<?php

declare(strict_types=1);

namespace App\Infrastructure\Fixtures;

use App\Domain\Repository\IngredientRepositoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class IngredientFixtures extends Fixture
{
    private $ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function load(ObjectManager $manager)
    {
        $ingredient = $this->ingredientRepository->createIngredient('Tomate');
        $this->ingredientRepository->save($ingredient);
    }
}
