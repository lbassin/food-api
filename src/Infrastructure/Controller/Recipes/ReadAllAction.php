<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\Recipes;

use App\Domain\Repository\RecipeRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class ReadAllAction
{

    private $recipeRepository;

    public function __construct(RecipeRepositoryInterface $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function handle(): Response
    {
        $recipes = $this->recipeRepository->getAll();
        print_r($recipes);

        return new Response('Recipes');
    }
}
