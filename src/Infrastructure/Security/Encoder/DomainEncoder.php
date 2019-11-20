<?php

declare(strict_types=1);

namespace App\Infrastructure\Security\Encoder;

use App\Domain\Value\User\Password;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class DomainEncoder implements PasswordEncoderInterface
{
    public function encodePassword($raw, $salt)
    {
        try {
            return Password::fromRawString($raw)->getRawValue();
        } catch (\Throwable $exception) {
            throw new BadCredentialsException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    public function isPasswordValid($encoded, $raw, $salt): bool
    {
        try {
            $password = Password::fromHash($encoded);
        } catch (\Throwable $exception) {
            throw new \InvalidArgumentException($exception->getMessage(), $exception->getCode(), $exception);
        }

        return $password->equals(Password::fromRawString($raw));
    }
}
