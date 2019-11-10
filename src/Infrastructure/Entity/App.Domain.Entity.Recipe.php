<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;

/** @var ClassMetadata $metadata */
$builder = new ClassMetadataBuilder($metadata);

$builder
    ->createField('id', Types::INTEGER)
    ->makePrimaryKey()
    ->build();

$builder
    ->createField('name', Types::STRING)
    ->length(255)
    ->nullable(false)
    ->build();

$builder
    ->createField('portion', Types::INTEGER)
    ->length(1)
    ->nullable(false)
    ->build();

$builder
    ->createField('duration', Types::INTEGER)
    ->length(3)
    ->nullable(false)
    ->build();

$builder
    ->createField('complexity', Types::INTEGER)
    ->length(1)
    ->nullable(false)
    ->build();
