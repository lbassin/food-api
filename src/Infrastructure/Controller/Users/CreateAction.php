<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\Users;

use App\Application\Factory\UserFactory;
use App\Infrastructure\Factory\UserDTOFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CreateAction
{
    private $dtoFactory;
    private $userFactory;
    private $serializer;

    public function __construct(UserDTOFactory $dtoFactory, UserFactory $userFactory, SerializerInterface $serializer)
    {
        $this->dtoFactory = $dtoFactory;
        $this->userFactory = $userFactory;
        $this->serializer = $serializer;
    }

    public function handle(Request $request): Response
    {
        $dto = $this->dtoFactory->createFromRequest($request);
        $user = $this->userFactory->createUser($dto);

        $response = $this->serializer->serialize($user, 'json');

        return new JsonResponse($response, Response::HTTP_OK, [], true);
    }
}
