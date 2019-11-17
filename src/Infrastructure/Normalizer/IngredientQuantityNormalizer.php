<?php

declare(strict_types=1);

namespace App\Infrastructure\Normalizer;

use App\Domain\Entity\IngredientQuantity;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class IngredientQuantityNormalizer implements NormalizerInterface
{
    /**
     * @var IngredientQuantity $ingredientQuantity
     */
    public function normalize($ingredientQuantity, $format = null, array $context = []): array
    {
        return [
            'name' => $ingredientQuantity->getIngredient()->getName()->getValue(),
            'quantity' => $ingredientQuantity->getQuantity()
        ];
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof IngredientQuantity && $format === 'json';
    }
}
