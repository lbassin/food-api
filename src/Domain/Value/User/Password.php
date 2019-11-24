<?php

declare(strict_types=1);

namespace App\Domain\Value\User;

use App\Domain\Exception\User\PasswordTooShortException;
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
            $this->initFromRaw($raw);
        }

        if (empty($raw)) {
            $this->initFromHash($hash);
        }
    }

    private function initFromRaw(string $raw): void
    {
        $this->raw = $raw;

        if (strlen($raw) < 6) {
            throw new PasswordTooShortException();
        }

        $this->hashed = password_hash($this->raw, PASSWORD_BCRYPT);
    }

    private function initFromHash(string $hash): void
    {
        $this->hashed = $hash;
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
