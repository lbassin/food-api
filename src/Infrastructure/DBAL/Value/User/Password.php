<?php

declare(strict_types=1);

namespace App\Infrastructure\DBAL\Value\User;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class Password extends StringType
{
    const NAME = 'password';

    public function getName()
    {
        return self::NAME;
    }

    /**
     * @var \App\Domain\Value\User\Password $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->getHashedValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return \App\Domain\Value\User\Password::fromHash($value);
    }
}
