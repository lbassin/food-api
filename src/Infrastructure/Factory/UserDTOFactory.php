<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Application\DTO\UserDTO;
use Symfony\Component\HttpFoundation\Request;

class UserDTOFactory
{
    public function createFromRequest(Request $request)
    {
        $dto = new UserDTO();

        $dto->setEmail($request->request->get('username'));
        $dto->setPassword($request->request->get('password'));

        return $dto;
    }
}
