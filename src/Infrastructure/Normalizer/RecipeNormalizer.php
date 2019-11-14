<?php

declare(strict_types=1);

namespace App\Infrastructure\Normalizer;

use App\Domain\Entity\Recipe;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RecipeNormalizer implements NormalizerInterface
{
    const FIELD_STEP = 'field_step';

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
        $steps = $this->normalizeSteps($recipe, $context);

        return [
                'id' => $recipe->getId(),
                'name' => $recipe->getName()->getValue(),
                'portion' => $recipe->getPortion()->getValue(),
                'duration' => $recipe->getDurationInMinutes()->getMinutes(),
                'complexity' => $recipe->getComplexity()->getValue(),
            ] + $steps;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Recipe && $format === 'json';
    }

    private function normalizeSteps(Recipe $recipe, array $context): array
    {
        if (!isset($context[self::FIELD_STEP]) || $context[self::FIELD_STEP] !== true) {
            return [];
        }

        $recipeStepNormalizer = $this->recipeStepNormalizer;

        return [
            'steps' => array_map(function ($step) use ($recipeStepNormalizer) {
                return $recipeStepNormalizer->normalize($step);
            }, $recipe->getSteps()),
        ];
    }
}
