<?php

declare(strict_types=1);

namespace App\Infrastructure\Fixtures;

use App\Domain\Repository\UserRepositoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager)
    {
        $user = $this->userRepository->createUser('john@doe.com', 's3cr3t');
        $this->userRepository->save($user);
    }
}
