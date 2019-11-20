<?php

declare(strict_types=1);

use App\Domain\Entity\Recipe;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use OpenApi\Annotations as OA;
use Ramsey\Uuid\Doctrine\UuidType;

/** @var ClassMetadata $metadata */
$builder = new ClassMetadataBuilder($metadata);

/**
 * @OA\Schema(
 *      schema="RecipeStep",
 *      title="RecipeStep",
 *      properties={
 *          @OA\Property(property="instruction", type="string")
 *      }
 * )
 */

$builder
    ->createField('id', UuidType::NAME)
    ->makePrimaryKey()
    ->build();

$builder
    ->createManyToOne('recipe', Recipe::class)
    ->addJoinColumn('recipe_id', 'id', false)
    ->inversedBy('steps')
    ->build();

$builder
    ->createField('position', Types::INTEGER)
    ->length(2)
    ->nullable(false)
    ->build();

$builder
    ->createField('instruction', Types::STRING)
    ->nullable(false)
    ->build();

$builder
    ->createOneToMany('ingredients', \App\Domain\Entity\IngredientQuantity::class)
    ->mappedBy('step')
    ->build();

$builder->addUniqueConstraint(['recipe_id', 'position'], 'RECIPE_STEP_POSITION_UNIQUE');

