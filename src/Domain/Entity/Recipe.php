<?php

declare(strict_types=1);

namespace App\Domain\Entity;

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

    public function __construct(UuidInterface $id, string $name, int $portion, int $duration, int $complexity)
    {

    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPortion(): int
    {
        return $this->portion;
    }

    public function getDurationInMinutes(): int
    {
        return $this->duration;
    }

    public function getComplexity(): int
    {
        return $this->complexity;
    }

    public function getSteps(): array
    {
        return $this->steps->toArray();
    }
}
