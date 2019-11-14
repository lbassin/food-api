<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Ramsey\Uuid\UuidInterface;

class RecipeStep
{
    private $id;

    private $recipe;

    private $position;

    private $instruction;

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
}
