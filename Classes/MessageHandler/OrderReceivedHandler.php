<?php
declare(strict_types=1);

namespace DanielGoerz\MessengerExample\MessageHandler;

use DanielGoerz\MessengerExample\Message\OrderSavedMessage;
use DanielGoerz\MessengerExample\Message\OrderReceivedMessage;
use Symfony\Component\Messenger\MessageBusInterface;

class OrderReceivedHandler
{
    public function __construct(private readonly MessageBusInterface $bus)
    {
    }

    public function __invoke(OrderReceivedMessage $message): void
    {
        // Write Order to database

        // Dispatch new event message
        $this->bus->dispatch(OrderSavedMessage::fromOrderReceivedMessage($message));
    }
}
