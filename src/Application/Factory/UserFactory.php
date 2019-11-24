<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Application\DTO\UserDTO;
use App\Domain\Entity\User;
use App\Domain\Repository\CalendarRepositoryInterface;
use App\Domain\Repository\DayRepositoryInterface;
use App\Domain\Repository\MealRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;

class UserFactory
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

    public function createUser(UserDTO $dto): User
    {
        $user = $this->userRepository->createUser($dto->getEmail(), $dto->getPassword());
        $this->userRepository->save($user);

        $calendar = $this->calendarRepository->createCalendarForUser($user);
        $this->calendarRepository->save($calendar);

        $this->dayRepository->createAndSaveAllDaysForCalendar($calendar);
        foreach ($calendar->getDays() as $day) {
            $this->mealRepository->createAndSaveAllMealsForDay($day);
        }

        // TODO: Dispatch event (user_created)

        return $user;
    }
}
