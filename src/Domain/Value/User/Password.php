<?php

declare(strict_types=1);

namespace App\Domain\Value\User;

use App\Domain\Exception\Value\RawPasswordNotAvailableException;
use App\Domain\Exception\Value\RawPasswordShouldHaveNoHashProvidedException;

class Password
{
    private $raw;
    private $hashed;

    static public function fromHash(string $hash): self
    {
        return new self(null, $hash);
    }

    static public function fromRawString(string $raw): self
    {
        return new self($raw);
    }

    private function __construct(string $raw = null, string $hash = null)
    {
        if (!empty($raw) && !empty($hash)) {
            throw new RawPasswordShouldHaveNoHashProvidedException();
        }

        if (empty($hash)) {
            $this->raw = $raw;
            $this->hashed = password_hash($this->raw, PASSWORD_BCRYPT);

        }

        if (empty($raw)) {
            $this->hashed = $hash;
        }
    }

    public function getRawValue(): string
    {
        if (empty($this->raw)) {
            throw new RawPasswordNotAvailableException();
        }

        return $this->raw;
    }

    public function getHashedValue(): string
    {
        return $this->hashed;
    }

    public function equals(Password $password): bool
    {
        return password_verify($password->getRawValue(), $this->getHashedValue());
    }
}
