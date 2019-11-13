<?php

declare(strict_types=1);

namespace App\Infrastructure\DBAL\Value;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class RecipeName extends StringType
{
    const NAME = 'recipe_name';

    public function getName()
    {
        return self::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new \App\Domain\Value\RecipeName($value);
    }
}
