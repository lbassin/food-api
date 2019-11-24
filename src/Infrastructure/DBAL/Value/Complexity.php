<?php

declare(strict_types=1);

namespace App\Infrastructure\DBAL\Value;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

class Complexity extends IntegerType
{
    const NAME = 'complexity';

    public function getName()
    {
        return self::NAME;
    }

    /**
     * @var \App\Domain\Value\Complexity $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->getValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new \App\Domain\Value\Complexity((int) $value);
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
