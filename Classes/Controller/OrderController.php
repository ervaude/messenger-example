<?php
declare(strict_types=1);

namespace DanielGoerz\MessengerExample\Controller;

use DanielGoerz\MessengerExample\Domain\DTO\Order;
use DanielGoerz\MessengerExample\Message\OrderReceivedMessage;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class OrderController extends ActionController
{
    public function __construct(private readonly MessageBusInterface $bus)
    {
    }

    public function createAction(): ResponseInterface
    {
        $this->view->assign('order', Order::createNew());
        return $this->htmlResponse();
    }

    public function finishAction(Order $order = null): ResponseInterface
    {
        if ($order === null) {
            return $this->redirect('create');
        }
        $this->bus->dispatch(OrderReceivedMessage::fromOrder($order));
        return $this->htmlResponse();
    }
}
