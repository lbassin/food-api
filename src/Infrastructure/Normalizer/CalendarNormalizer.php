<?php

declare(strict_types=1);

namespace App\Infrastructure\Normalizer;

use App\Domain\Entity\Calendar;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CalendarNormalizer implements NormalizerInterface
{
    private $dayNormalizer;

    public function __construct(DayNormalizer $dayNormalizer)
    {
        $this->dayNormalizer = $dayNormalizer;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Calendar && $format === 'json';
    }

    /**
     * @var Calendar $calendar
     */
    public function normalize($calendar, $format = null, array $context = []): array
    {
        return [
            'days' => $this->normalizeDays($calendar),
        ];
    }

    private function normalizeDays(Calendar $calendar): array
    {
        $dayNormalizer = $this->dayNormalizer;

        return array_map(function ($day) use ($dayNormalizer) {
            return $dayNormalizer->normalize($day, 'json');
        }, $calendar->getDays());
    }
}
