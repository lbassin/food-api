<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use App\Domain\Entity\Recipe;
use Throwable;

class RecipeAlreadyPublishedException extends \RuntimeException
{
    public function __construct(Recipe $recipe, Throwable $previous = null)
    {
        $message = sprintf('Recipe already published (%s)', $recipe->getId());

        parent::__construct($message, ExceptionTypes::DOMAIN, $previous);
    }
}
