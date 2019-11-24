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
    ->createManyToOne('calendar', \App\Domain\Entity\Calendar::class)
    ->inversedBy('days')
    ->addJoinColumn('calendar_id', 'id', false, false, 'CASCADE')
    ->build();

$builder
    ->createField('position', \Doctrine\DBAL\Types\Types::INTEGER)
    ->length(2)
    ->nullable(false)
    ->build();

$builder
    ->createOneToMany('meals', \App\Domain\Entity\Meal::class)
    ->setOrderBy(['position' => 'ASC'])
    ->mappedBy('day')
    ->build();

$builder->addUniqueConstraint(['calendar_id', 'position'], 'DAY_CALENDAR_POSITION_UNIQUE');
