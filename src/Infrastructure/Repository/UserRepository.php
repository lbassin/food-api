<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Value\User\Email;
use App\Domain\Value\User\Password;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UserRepository implements UserRepositoryInterface
{
    private $entityManager;
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(User::class);
    }

    public function createUser(string $email, string $password): User
    {
        return new User(
            $this->nextIdentity(),
            new Email($email),
            new Password($password)
        );
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    private function nextIdentity(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
