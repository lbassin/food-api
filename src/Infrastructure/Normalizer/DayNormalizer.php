<?php

declare(strict_types=1);

namespace App\Infrastructure\Normalizer;

use App\Domain\Entity\Day;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DayNormalizer implements NormalizerInterface
{
    private $mealNormalizer;

    public function __construct(MealNormalizer $mealNormalizer)
    {
        $this->mealNormalizer = $mealNormalizer;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Day && $format === 'json';
    }

    /**
     * @var Day $day
     */
    public function normalize($day, $format = null, array $context = []): array
    {
        return [
            'position' => $day->getPosition(),
            'meals' => $this->normalizeMeals($day),
        ];
    }

    public function normalizeMeals(Day $day): array
    {
        $mealNormalizer = $this->mealNormalizer;

        return array_map(function ($meal) use ($mealNormalizer) {
            return $mealNormalizer->normalize($meal, 'json');
        }, $day->getMeals());
    }
}
