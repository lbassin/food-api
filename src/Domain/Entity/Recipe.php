<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Exception\RecipeAlreadyPublishedException;
use App\Domain\Value\Complexity;
use App\Domain\Value\Duration;
use App\Domain\Value\Portion;
use App\Domain\Value\RecipeName;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

class Recipe
{
    private $id;

    private $name;

    private $portion;

    private $duration;

    private $complexity;

    /** @var \Doctrine\Common\Collections\ArrayCollection $steps */
    private $steps;

    private $draft;

    public function __construct(
        UuidInterface $id,
        RecipeName $name,
        Portion $portion,
        Duration $duration,
        Complexity $complexity
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->portion = $portion;
        $this->duration = $duration;
        $this->complexity = $complexity;
        $this->steps = new ArrayCollection();
        $this->draft = true;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): RecipeName
    {
        return $this->name;
    }

    public function getPortion(): Portion
    {
        return $this->portion;
    }

    public function getDurationInMinutes(): Duration
    {
        return $this->duration;
    }

    public function getComplexity(): Complexity
    {
        return $this->complexity;
    }

    public function getSteps(): array
    {
        return $this->steps->toArray();
    }

    public function publish(): void
    {
        if ($this->draft === false) {
            throw new RecipeAlreadyPublishedException($this);
        }

        $this->draft = false;
    }

    public function addStep($step): void
    {
        $this->steps[] = $step;
    }
}
