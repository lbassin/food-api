<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Application\DTO\UserDTO;
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
        $user = $this->userRepository->createUser($dto->getEmail(), $dto->getPassword());
        $this->userRepository->save($user);

        // TODO: Dispatch event (user_created)

        return $user;
    }
}
