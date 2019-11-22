<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\User;
use App\Domain\Exception\UserAlreadyExistsException;

interface UserRepositoryInterface
{
    public function createUser(string $email, string $password): User;

    /**
     * @throws UserAlreadyExistsException
     */
    public function save(User $user): void;

    public function getByEmail(string $email): User;
}
