<?php

declare(strict_types=1);

namespace App\Infrastructure\Fixtures;

use App\Domain\Repository\CalendarRepositoryInterface;
use App\Domain\Repository\DayRepositoryInterface;
use App\Domain\Repository\MealRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $userRepository;
    private $calendarRepository;
    private $dayRepository;
    private $mealRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        CalendarRepositoryInterface $calendarRepository,
        DayRepositoryInterface $dayRepository,
        MealRepositoryInterface $mealRepository
    ) {
        $this->userRepository = $userRepository;
        $this->calendarRepository = $calendarRepository;
        $this->dayRepository = $dayRepository;
        $this->mealRepository = $mealRepository;
    }

    public function load(ObjectManager $manager)
    {
        $users = [
            ['email' => 'john@doe.com', 'password' => 's3cr3t'],
            ['email' => 'dev@user.com', 'password' => 'dev'],
        ];

        foreach ($users as $user) {
            ['email' => $email, 'password' => $password] = $user;

            $user = $this->userRepository->createUser($email, $password);
            $this->userRepository->save($user);

            $calendar = $this->calendarRepository->createCalendarForUser($user);
            $this->calendarRepository->save($calendar);

            $this->dayRepository->createAndSaveAllDaysForCalendar($calendar);
            foreach ($calendar->getDays() as $day) {
                $this->mealRepository->createAndSaveAllMealsForDay($day);
            }
        }

    }
}
