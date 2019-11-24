<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\Profile;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ReadAction
{
    private $serializer;
    private $tokenStorage;

    public function __construct(SerializerInterface $serializer, TokenStorageInterface $tokenStorage)
    {
        $this->serializer = $serializer;
        $this->tokenStorage = $tokenStorage;
    }

    public function handle(): Response
    {
        $profile = $this->tokenStorage->getToken()->getUser();

        $data = $this->serializer->serialize($profile, 'json');

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
