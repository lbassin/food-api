<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Domain\DTO\UserDTO;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;

class UserFactory
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(UserDTO $dto): User
    {
        // TODO: Dispatch event

        $user = $this->userRepository->createUser($dto->email, $dto->password);

        // TODO: Dispatch event

        return $user;
    }
}
