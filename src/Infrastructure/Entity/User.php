<?php

declare(strict_types=1);

namespace App\Infrastructure\Entity;

use App\Domain\Value\User\Email;
use App\Domain\Value\User\Password;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, \App\Domain\Entity\User
{
    protected $id;

    protected $email;

    protected $password;

    protected $createdAt;

    public function __construct(UuidInterface $id, Email $email, Password $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getRoles(): array
    {
        return [];
    }

    public function getPassword(): string
    {
        return $this->password->getHashedValue();
    }

    public function getSalt(): void
    {
        return;
    }

    public function getUsername(): string
    {
        return $this->email->getValue();
    }

    public function eraseCredentials(): void
    {
        return;
    }
}
