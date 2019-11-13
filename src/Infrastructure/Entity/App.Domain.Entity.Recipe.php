<?php

declare(strict_types=1);

use App\Domain\Entity\RecipeStep;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use OpenApi\Annotations as OA;
use Ramsey\Uuid\Doctrine\UuidType;

/** @var ClassMetadata $metadata */
$builder = new ClassMetadataBuilder($metadata);

/**
 * @OA\Schema(
 *      schema="Recipe",
 *      type="object",
 *      properties={
 *          @OA\Property(property="id", type="uuid"),
 *          @OA\Property(property="name", type="string"),
 *          @OA\Property(property="portion", type="integer", description="Number of people the recipe is made for"),
 *          @OA\Property(property="duration", type="integer", description="Duration in minute"),
 *          @OA\Property(property="complexity", type="integer", description="Complexity between 0 and 5")
 *      }
 * )
 */


$builder
    ->createField('id', UuidType::NAME)
    ->makePrimaryKey()
    ->build();

$builder
    ->createField('name', \App\Infrastructure\DBAL\Value\RecipeName::NAME)
    ->length(255)
    ->nullable(false)
    ->build();

$builder
    ->createField('portion', \App\Infrastructure\DBAL\Value\Portion::NAME)
    ->length(1)
    ->nullable(false)
    ->build();

$builder
    ->createField('duration', \App\Infrastructure\DBAL\Value\Duration::NAME)
    ->length(3)
    ->nullable(false)
    ->build();

$builder
    ->createField('complexity', \App\Infrastructure\DBAL\Value\Complexity::NAME)
    ->length(1)
    ->nullable(false)
    ->build();

$builder
    ->createOneToMany('steps', RecipeStep::class)
    ->setOrderBy(['position' => 'ASC'])
    ->mappedBy('recipe')
    ->build();

$builder
    ->createField('draft', Types::BOOLEAN)
    ->nullable(false)
    ->option('default', 1)
    ->build();