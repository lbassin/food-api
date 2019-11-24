<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Value\User\Email;
use App\Domain\Value\User\Password;
use Ramsey\Uuid\UuidInterface;

abstract class User
{
    protected $id;

    protected $email;

    protected $password;

    protected $calendar;

    protected $createdAt;

    public function __construct(UuidInterface $id, Email $email, Password $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getCalendar(): Calendar
    {
        return $this->calendar;
    }
}