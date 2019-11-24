<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\Profile\Calendar\Days\Meals;

use App\Domain\Entity\User;
use App\Domain\Repository\DayRepositoryInterface;
use App\Domain\Repository\MealRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ReadAction
{
    private $serializer;
    private $tokenStorage;
    private $dayRepository;
    private $mealRepository;

    public function __construct(
        SerializerInterface $serializer,
        TokenStorageInterface $tokenStorage,
        DayRepositoryInterface $dayRepository,
        MealRepositoryInterface $mealRepository
    ) {
        $this->serializer = $serializer;
        $this->tokenStorage = $tokenStorage;
        $this->dayRepository = $dayRepository;
        $this->mealRepository = $mealRepository;
    }

    public function handle(Request $request): Response
    {
        /** @var User $user */
        $user = $this->tokenStorage->getToken()->getUser();
        $dayPosition = (int) $request->attributes->get('dayPosition');
        $mealPosition = (int) $request->attributes->get('mealPosition');

        $day = $this->dayRepository->getOneByUserAndPosition($user, $dayPosition);
        $meal = $this->mealRepository->getOneByDayAndPosition($day, $mealPosition);

        $data = $this->serializer->serialize($meal, 'json');

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
