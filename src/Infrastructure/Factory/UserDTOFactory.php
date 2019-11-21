<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\DTO\UserDTO;
use Symfony\Component\HttpFoundation\Request;

class UserDTOFactory
{
    public function createFromRequest(Request $request)
    {
        $dto = new UserDTO();

        $dto->email = $request->request->get('username');
        $dto->password = $request->request->get('password');

        return $dto;
    }
}
