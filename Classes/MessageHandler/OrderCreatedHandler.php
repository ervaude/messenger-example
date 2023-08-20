<?php
declare(strict_types=1);

namespace DanielGoerz\MessengerExample\MessageHandler;

use DanielGoerz\MessengerExample\Message\OrderSavedMessage;
use TYPO3\CMS\Core\Mail\MailerInterface;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MailUtility;

class OrderCreatedHandler
{
    public function __construct(private readonly MailerInterface $mailer)
    {
    }

    public function __invoke(OrderSavedMessage $message): void
    {
        $mail = GeneralUtility::makeInstance(MailMessage::class);
        $mail->to($message->getEmail())
            ->from(MailUtility::getSystemFromAddress())
            ->subject('Thank you for your order')
            ->html("<h1>Thank you for your order</h1>
<p>You ordered {$message->getAmount()} things!</p>");
        $this->mailer->send($mail);
    }
}
