<?php

declare(strict_types=1);

namespace App\Infrastructure\DBAL\Value;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

class Duration extends IntegerType
{
    const NAME = 'duration';

    public function getName()
    {
        return self::NAME;
    }

    /**
     * @var \App\Domain\Value\Duration $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->getMinutes();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new \App\Domain\Value\Duration((int) $value);
    }
}
