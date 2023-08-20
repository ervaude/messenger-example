<?php
declare(strict_types=1);

namespace DanielGoerz\MessengerExample\Domain\DTO;

class Order
{
    public function __construct(private readonly string $email, private readonly int $amount)
    {
    }

    public static function createNew(): self
    {
        return new self('john.doe@example.com', 2);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

}
