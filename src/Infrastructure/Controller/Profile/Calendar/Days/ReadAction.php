<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\Profile\Calendar\Days;

use App\Domain\Entity\User;
use App\Domain\Repository\DayRepositoryInterface;
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

    public function __construct(
        SerializerInterface $serializer,
        TokenStorageInterface $tokenStorage,
        DayRepositoryInterface $dayRepository
    ) {
        $this->serializer = $serializer;
        $this->tokenStorage = $tokenStorage;
        $this->dayRepository = $dayRepository;
    }

    public function handle(Request $request): Response
    {
        /** @var User $user */
        $user = $this->tokenStorage->getToken()->getUser();
        $position = (int) $request->attributes->get('dayPosition');

        $day = $this->dayRepository->getOneByUserAndPosition($user, $position);

        $data = $this->serializer->serialize($day, 'json');

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
