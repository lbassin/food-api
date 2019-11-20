<?php

declare(strict_types=1);

namespace App\Infrastructure\Security;

use App\Domain\Exception\UserNotFoundException;
use App\Domain\Repository\UserRepositoryInterface;
use App\Infrastructure\Entity\User;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loadUserByUsername($username)
    {
        try {
            return $this->userRepository->getByEmail($username);
        } catch (UserNotFoundException $exception) {
            throw new UsernameNotFoundException();
        }
    }

    public function refreshUser(UserInterface $user): bool
    {
        return true;
    }

    public function supportsClass($class)
    {
        return $class instanceof User;
    }
}
