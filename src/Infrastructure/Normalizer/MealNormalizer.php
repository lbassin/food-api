<?php

declare(strict_types=1);

namespace App\Infrastructure\Normalizer;

use App\Domain\Entity\Meal;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MealNormalizer implements NormalizerInterface
{
    private $recipeNormalizer;

    public function __construct(RecipeNormalizer $recipeNormalizer)
    {
        $this->recipeNormalizer = $recipeNormalizer;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Meal && $format === 'json';
    }

    /**
     * @var Meal $meal
     */
    public function normalize($meal, $format = null, array $context = []): array
    {
        return [
            'position' => $meal->getPosition(),
            'portion' => $meal->getPortion() ? $meal->getPortion()->getValue() : null,
            'recipe' => $meal->getRecipe() ? $this->recipeNormalizer->normalize($meal->getRecipe(), 'json') : null,
        ];
    }
}
