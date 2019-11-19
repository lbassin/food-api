<?php

declare(strict_types=1);

namespace App\Infrastructure\DBAL\Value\User;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class Email extends StringType
{
    const NAME = 'email';
    
    public function getName()
    {
        return self::NAME;
    }

    /**
     * @var \App\Domain\Value\User\Email $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->getValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new \App\Domain\Value\User\Email($value);
    }
}
