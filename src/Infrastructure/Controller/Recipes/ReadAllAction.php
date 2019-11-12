<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\Recipes;

use App\Domain\Repository\RecipeRepositoryInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ReadAllAction
{

    private $recipeRepository;

    private $serializer;

    /**
     * @OA\Get(
     *      path="/recipes",
     *      summary="Get the list of the validated recipes",
     *      @OA\Response(response="200", description="success", @OA\Schema(ref="#components/schemas/Recipe"))
     * )
     */
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
