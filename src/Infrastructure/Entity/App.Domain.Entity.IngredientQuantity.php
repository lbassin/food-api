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
    ->createManyToOne('ingredient', \App\Domain\Entity\Ingredient::class)
    ->addJoinColumn('ingredient_id', 'id', false)
    ->build();

// TODO: Join on composite key (recipe/position) instead of primary
$builder
    ->createManyToOne('step', \App\Domain\Entity\RecipeStep::class)
    ->addJoinColumn('step_id', 'id', false)
    ->build();

$builder
    ->createField('quantity', \Doctrine\DBAL\Types\Types::INTEGER)
    ->nullable(false)
    ->build();
