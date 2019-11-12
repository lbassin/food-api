<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\Recipes;

use App\Domain\Repository\RecipeRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ReadAllAction
{

    private $recipeRepository;
    private $serializer;

    public function __construct(RecipeRepositoryInterface $recipeRepository, SerializerInterface $serializer)
    {
        $this->recipeRepository = $recipeRepository;
        $this->serializer = $serializer;
    }

    public function handle(): Response
    {
        $recipes = $this->recipeRepository->getAllNoneDraft();

        $data = $this->serializer->serialize($recipes, 'json');

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
