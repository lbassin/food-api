<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\Types;
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
    ->createField('email', \App\Infrastructure\DBAL\Value\User\Email::NAME)
    ->length(255)
    ->nullable(false)
    ->unique(true)
    ->build();

$builder
    ->createField('password', \App\Infrastructure\DBAL\Value\User\Password::NAME)
    ->length(255)
    ->nullable(false)
    ->build();

$builder
    ->createField('createdAt', Types::DATE_IMMUTABLE)
    ->columnName('created_at')
    ->nullable(false)
    ->build();