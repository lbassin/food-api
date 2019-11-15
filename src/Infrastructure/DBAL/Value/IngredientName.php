<?php

declare(strict_types=1);

namespace App\Infrastructure\DBAL\Value;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class IngredientName extends StringType
{
    const NAME = 'ingredient_name';

    public function getName()
    {
        return self::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new \App\Domain\Value\IngredientName($value);
    }
}
