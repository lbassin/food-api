<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Value\User\Email;
use App\Domain\Value\User\Password;
use Ramsey\Uuid\UuidInterface;

class User
{
    private $id;

    private $email;

    private $password;

    private $createdAt;

    public function __construct(UuidInterface $id, Email $email, Password $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new \DateTimeImmutable();
    }
}
