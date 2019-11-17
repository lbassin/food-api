<?php

declare(strict_types=1);

namespace App\Infrastructure\DBAL\Value;

use App\Domain\Value\Quantity\LiquidQuantity;
use App\Domain\Value\Quantity\UnitQuantity;
use App\Domain\Value\Quantity\WeightQuantity;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class Quantity extends StringType
{
    const NAME = 'quantity';

    /**
     * @var \App\Domain\Value\Quantity\Quantity $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return substr(sprintf('%s#%s', $value->getType(), $value->getValueAsString()), 0, 255);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        [$type, $value] = explode('#', $value, 2);

        $matchedClass = null;
        foreach ($this->getTypeClassMapping() as $classType => $className) {
            if ($type !== $classType) {
                continue;
            }

            $matchedClass = $className;
        }

        if (!$matchedClass) {
            throw new \RuntimeException(sprintf('No quantity class found for type \'%s\'', $type));
        }

        try {
            $class = new \ReflectionClass($matchedClass);
        } catch (\ReflectionException $e) {
            throw new \RuntimeException(sprintf('Class %s for type \'%s\' doesn\'t exist', $matchedClass, $type));
        }

        [$constructorArg] = $class->getConstructor()->getParameters();
        settype($value, $constructorArg->getType()->getName());

        return new $matchedClass($value);

    }

    public function getTypeClassMapping(): array
    {
        return [
            'unit' => UnitQuantity::class,
            'weight' => WeightQuantity::class,
            'liquid' => LiquidQuantity::class,
        ];
    }

    public function getName()
    {
        return self::NAME;
    }
}
