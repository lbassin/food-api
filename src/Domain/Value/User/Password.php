<?php

declare(strict_types=1);

namespace App\Domain\Value\User;

class Password
{
    private $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function getHashedValue(): string
    {
        return password_hash($this->password, PASSWORD_BCRYPT);
    }
}
