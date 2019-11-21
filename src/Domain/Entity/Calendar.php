<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

class Calendar
{
    private $id;

    private $user;

    private $days;

    public function __construct(UuidInterface $id, User $user)
    {
        $this->id = $id;
        $this->user = $user;
        $this->days = new ArrayCollection();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getDays(): array
    {
        return $this->days->toArray();
    }
}
