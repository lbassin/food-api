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
    ->createOneToOne('user', \App\Infrastructure\Entity\User::class)
    ->addJoinColumn('user_id', 'id', false, true, 'CASCADE')
    ->inversedBy('calendar')
    ->build();

$builder
    ->createOneToMany('days', \App\Domain\Entity\Day::class)
    ->setOrderBy(['position' => 'ASC'])
    ->mappedBy('calendar')
    ->build();

