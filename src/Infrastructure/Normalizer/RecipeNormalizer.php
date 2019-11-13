<?php

declare(strict_types=1);

namespace App\Infrastructure\Normalizer;

use App\Domain\Entity\Recipe;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RecipeNormalizer implements NormalizerInterface
{
    private $recipeStepNormalizer;

    public function __construct(RecipeStepNormalizer $recipeStepNormalizer)
    {
        $this->recipeStepNormalizer = $recipeStepNormalizer;
    }

    /**
     * @param $recipe Recipe
     */
    public function normalize($recipe, $format = null, array $context = []): array
    {
        return [
            'id' => $recipe->getId(),
            'name' => $recipe->getName(),
            'portion' => $recipe->getPortion(),
            'duration' => $recipe->getDurationInMinutes(),
            'complexity' => $recipe->getComplexity(),
            'steps' => $this->normalizeSteps($recipe->getSteps()),
        ];
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Recipe && $format === 'json';
    }

    private function normalizeSteps(array $steps): array
    {
        $recipeStepNormalizer = $this->recipeStepNormalizer;

        return array_map(function ($step) use ($recipeStepNormalizer) {
            return $recipeStepNormalizer->normalize($step);
        }, (array) $steps);
    }
}
