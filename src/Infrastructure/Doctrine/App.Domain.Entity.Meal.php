<?php

declare(strict_types=1);

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ramsey\Uuid\Doctrine\UuidType;

/** @var ClassMetadata $metadata */
$builder = new ClassMetadataBuilder($metadata);

$builder
    ->createField('id', UuidType::NAME)
    ->makePrimaryKey()
    ->build();

$builder
    ->createManyToOne('day', \App\Domain\Entity\Day::class)
    ->addJoinColumn('day_id', 'id', false, false, 'CASCADE')
    ->inversedBy('meals')
    ->build();

$builder
    ->createField('position', \Doctrine\DBAL\Types\Types::INTEGER)
    ->length(2)
    ->nullable(false)
    ->build();

$builder
    ->createManyToOne('recipe', \App\Domain\Entity\Recipe::class)
    ->addJoinColumn('recipe_id', 'id', true)
    ->build();

$builder
    ->createField('portion', \App\Infrastructure\DBAL\Value\Portion::NAME)
    ->length(1)
    ->nullable(true)
    ->build();

$builder->addUniqueConstraint(['day_id', 'position'], 'MEAL_DAY_POSITION_UNIQUE');
