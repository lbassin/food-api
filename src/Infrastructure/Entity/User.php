<?php

declare(strict_types=1);

namespace App\Infrastructure\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

class User extends \App\Domain\Entity\User implements UserInterface
{
    public function getRoles(): array
    {
        return ['ROLE_USER'];
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
