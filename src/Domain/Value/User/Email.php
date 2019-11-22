<?php

declare(strict_types=1);

namespace App\Domain\Value\User;

use App\Domain\Exception\InvalidEmailFormatException;

class Email
{
    private $email;

    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailFormatException($email);
        }

        $this->email = $email;
    }

    public function getValue(): string
    {
        return $this->email;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
