<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\Users;

use App\Application\Factory\UserFactory;
use App\Domain\Exception\UserAlreadyExistsException;
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

        try {
            $user = $this->userFactory->createUser($dto);
        } catch (UserAlreadyExistsException $exception) {
            return new JsonResponse(null, Response::HTTP_CONFLICT);
        }

        $response = $this->serializer->serialize($user, 'json');

        return new JsonResponse($response, Response::HTTP_CREATED, [], true);
    }
}
