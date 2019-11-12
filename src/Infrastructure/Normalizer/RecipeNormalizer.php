<?php

declare(strict_types=1);

namespace App\Infrastructure\Normalizer;

use App\Domain\Entity\Recipe;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RecipeNormalizer implements NormalizerInterface
{
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
        ];
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Recipe && $format === 'json';
    }
}
