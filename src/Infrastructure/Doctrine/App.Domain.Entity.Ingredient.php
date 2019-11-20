<?php

declare(strict_types=1);

use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use OpenApi\Annotations as OA;
use Ramsey\Uuid\Doctrine\UuidType;

/** @var ClassMetadata $metadata */
$builder = new ClassMetadataBuilder($metadata);

/**
 * @OA\Schema(
 *      schema="Ingredient",
 *      title="Ingredient",
 *      properties={
 *          @OA\Property(property="name", type="string")
 *      }
 * )
 */

$builder
    ->createField('id', UuidType::NAME)
    ->makePrimaryKey()
    ->build();

$builder
    ->createField('name', \App\Infrastructure\DBAL\Value\IngredientName::NAME)
    ->nullable(false)
    ->build();


