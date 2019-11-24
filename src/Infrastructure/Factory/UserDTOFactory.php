<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Application\DTO\UserDTO;
use App\Infrastructure\Exception\MissingDataForDTOException;
use Symfony\Component\HttpFoundation\Request;

class UserDTOFactory
{
    public function createFromRequest(Request $request)
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        if (empty($username) || empty($password)) {
            throw new MissingDataForDTOException(['username', 'password']);
        }

        $dto = new UserDTO();

        $dto->setEmail($username);
        $dto->setPassword($password);

        return $dto;
    }
}
