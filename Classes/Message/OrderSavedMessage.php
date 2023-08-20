<?php
declare(strict_types=1);

namespace DanielGoerz\MessengerExample\Message;

use Symfony\Component\Mime\Address;

class OrderSavedMessage
{
    public function __construct(private readonly string $email, private readonly int $amount)
    {
    }

    public function getEmail(): Address
    {
        return new Address($this->email);
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public static function fromOrderReceivedMessage(OrderReceivedMessage $message): self
    {
        return new self($message->getEmail(), $message->getAmount());
    }
}
