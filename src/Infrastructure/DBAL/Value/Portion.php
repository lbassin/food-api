<?php

declare(strict_types=1);

namespace App\Infrastructure\DBAL\Value;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

class Portion extends IntegerType
{
    const NAME = 'portion';

    public function getName()
    {
        return self::NAME;
    }

    /**
     * @var \App\Domain\Value\Portion $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!$value) {
            return null;
        }

        return $value->getValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (!$value) {
            return null;
        }

        return new \App\Domain\Value\Portion((int) $value);
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
