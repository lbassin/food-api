<?php

declare(strict_types=1);

namespace App\Infrastructure\Normalizer;

use App\Domain\Entity\RecipeStep;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RecipeStepNormalizer implements NormalizerInterface
{
    private $ingredientQuantityNormalizer;

    public function __construct(IngredientQuantityNormalizer $ingredientQuantityNormalizer)
    {
        $this->ingredientQuantityNormalizer = $ingredientQuantityNormalizer;
    }

    /**
     * @var RecipeStep $step
     */
    public function normalize($step, $format = null, array $context = []): array
    {
        return [
            'instruction' => $step->getInstruction(),
            'ingredients' => $this->normalizeIngredients($step),
        ];
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof RecipeStep && $format === 'json';
    }

    private function normalizeIngredients(RecipeStep $step): array
    {
        $ingredientQuantityNormalizer = $this->ingredientQuantityNormalizer;

        return array_map(function ($ingredientQuantity) use ($ingredientQuantityNormalizer) {
            return $ingredientQuantityNormalizer->normalize($ingredientQuantity);
        }, $step->getIngredients());
    }
}
