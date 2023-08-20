<?php

use DanielGoerz\MessengerExample\Controller\OrderController;
use DanielGoerz\MessengerExample\Message\OrderSavedMessage;
use TYPO3\CMS\Core\Messaging\WebhookMessageInterface;

defined('TYPO3') or die('Access denied!');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'messenger_example',
    'queue_plugin',
    [OrderController::class => 'create,finish'],
    [OrderController::class => 'create,finish']
);
unset($GLOBALS['TYPO3_CONF_VARS']['SYS']['messenger']['routing']['*']);
// Set Webhook-Messages and OrderSavedMessage to asynchronous transport via doctrine
foreach ([WebhookMessageInterface::class, OrderSavedMessage::class] as $className) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['messenger']['routing'][$className] = 'doctrine';
}
