<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\User;
use App\Domain\Exception\UserAlreadyExistsException;
use App\Domain\Exception\UserNotFoundException;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Value\User\Email;
use App\Domain\Value\User\Password;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
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
        $this->repository = $entityManager->getRepository(\App\Infrastructure\Entity\User::class);
    }

    public function createUser(string $email, string $password): User
    {
        return new \App\Infrastructure\Entity\User(
            $this->nextIdentity(),
            new Email($email),
            Password::fromRawString($password)
        );
    }

    public function save(User $user): void
    {
        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        } catch (\Throwable $exception) {
            if ($exception instanceof UniqueConstraintViolationException) {
                throw new UserAlreadyExistsException($user->getEmail()->getValue(), $exception);
            }
            
            throw $exception;
        }
    }

    public function getByEmail(string $email): User
    {
        /** @var User $user */
        $user = $this->repository->findOneBy(['email' => new Email($email)]);
        if (!$user) {
            throw new UserNotFoundException($email);
        }

        return $user;
    }

    private function nextIdentity(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
