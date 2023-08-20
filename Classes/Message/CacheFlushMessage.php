<?php
declare(strict_types=1);

namespace DanielGoerz\MessengerExample\Message;

use TYPO3\CMS\Core\Attribute\WebhookMessage;
use TYPO3\CMS\Core\Cache\Event\CacheFlushEvent;
use TYPO3\CMS\Core\Messaging\WebhookMessageInterface;

#[WebhookMessage(identifier: 'dg/cache-flushed', description: '... when the cache was flushed from CLI')]
final class CacheFlushMessage implements WebhookMessageInterface
{
    public function __construct(private readonly array $groups)
    {
    }

    public static function createFromEvent(CacheFlushEvent $event): self
    {
        return new self($event->getGroups());
    }

    public function jsonSerialize(): array
    {
        return ['groups' => $this->groups];
    }
}
