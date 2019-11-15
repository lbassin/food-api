<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\Recipes;

use App\Domain\Exception\ExceptionTypes;
use App\Domain\Repository\RecipeRepositoryInterface;
use App\Infrastructure\Normalizer\RecipeNormalizer;
use OpenApi\Annotations as OA;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ReadOneAction
{

    private $recipeRepository;

    private $serializer;

    /**
     * @OA\Get(
     *      path="/recipes/{id}",
     *      summary="Get one recipe",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of the recipe",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              format="uuid"
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Items(ref="#/components/schemas/Recipe_Details")
     *          )
     *      )
     * )
     */
    public function __construct(RecipeRepositoryInterface $recipeRepository, SerializerInterface $serializer)
    {
        $this->recipeRepository = $recipeRepository;
        $this->serializer = $serializer;
    }

    public function handle(Request $request): Response
    {
        try {
            $id = Uuid::fromString($request->attributes->get('id'));
        } catch (InvalidUuidStringException $exception) {
            throw new \RuntimeException($exception->getMessage(), ExceptionTypes::DATA_PROVIDED_ERROR, $exception);
        }

        $recipe = $this->recipeRepository->getPublishedRecipeById($id);

        $data = $this->serializer->serialize($recipe, 'json', [RecipeNormalizer::FIELD_STEP => true]);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
