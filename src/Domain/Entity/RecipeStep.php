<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

class RecipeStep
{
    private $id;

    private $recipe;

    private $position;

    private $instruction;

    /** @var ArrayCollection */
    private $ingredients;

    public function __construct(UuidInterface $id, int $position, string $instruction, Recipe $recipe)
    {
        $this->id = $id;
        $this->position = $position;
        $this->instruction = $instruction;
        $this->recipe = $recipe;
    }

    public function getInstruction(): string
    {
        return $this->instruction;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function getIngredients(): array
    {
        return $this->ingredients->toArray();
    }
}
