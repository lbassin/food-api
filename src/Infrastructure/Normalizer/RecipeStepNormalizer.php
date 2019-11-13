<?php

declare(strict_types=1);

namespace App\Infrastructure\Normalizer;

use App\Domain\Entity\RecipeStep;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RecipeStepNormalizer implements NormalizerInterface
{

    /**
     * @var RecipeStep $step
     */
    public function normalize($step, $format = null, array $context = []): array
    {
        return [
            'instruction' => $step->getInstruction(),
        ];
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof RecipeStep && $format === 'json';
    }
}
