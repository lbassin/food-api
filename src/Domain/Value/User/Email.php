<?php

declare(strict_types=1);

namespace App\Domain\Value\User;

class Email
{
    private $email;

    public function __construct(string $email)
    {
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
