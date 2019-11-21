<?php

declare(strict_types=1);

namespace App\Infrastructure\Normalizer;

use App\Infrastructure\Entity\User;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UserNormalizer implements NormalizerInterface
{
    /**
     * @var User $user
     */
    public function normalize($user, $format = null, array $context = []): array
    {
        return [
            'username' => $user->getEmail()->getValue(),
            'roles' => $user->getRoles(),
        ];
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof User && $format === 'json';
    }
}
