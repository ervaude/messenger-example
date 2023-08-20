<?php
declare(strict_types=1);

namespace DanielGoerz\MessengerExample\Message;

use DanielGoerz\MessengerExample\Domain\DTO\Order;

class OrderReceivedMessage
{
    public function __construct(private readonly string $email, private readonly int $amount)
    {
    }

    public static function fromOrder(Order $order): self
    {
        return new self($order->getEmail(), $order->getAmount());
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
