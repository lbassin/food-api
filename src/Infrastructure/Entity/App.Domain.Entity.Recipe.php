<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use OpenApi\Annotations as OA;
use Ramsey\Uuid\Doctrine\UuidType;

/** @var ClassMetadata $metadata */
$builder = new ClassMetadataBuilder($metadata);

/**
 * @OA\Components(
 *      @OA\Schema(
 *          schema="Recipe",
 *          type="Recipe",
 *          type="object",
 *          properties={
 *              @OA\Property(property="id", type="uuid"),
 *              @OA\Property(property="name", type="string"),
 *              @OA\Property(property="portion", type="integer", description="Number of people the recipe is made for"),
 *              @OA\Property(property="duration", type="integer", description="Duration in minute"),
 *              @OA\Property(property="complexity", type="integer", description="Complexity between 0 and 5")
 *          }
 *     )
 * )
 */


$builder
    ->createField('id', UuidType::NAME)
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

$builder
    ->createField('draft', Types::BOOLEAN)
    ->nullable(false)
    ->option('default', 1)
    ->build();