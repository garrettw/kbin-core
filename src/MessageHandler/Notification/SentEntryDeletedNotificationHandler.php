<?php declare(strict_types=1);

namespace App\MessageHandler\Notification;

use App\Message\Notification\EntryDeletedNotificationMessage;
use App\Repository\EntryRepository;
use App\Service\NotificationManager;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SentEntryDeletedNotificationHandler implements MessageHandlerInterface
{
    public function __construct(
        private EntryRepository $repository,
        private NotificationManager $manager
    ) {
    }

    public function __invoke(EntryDeletedNotificationMessage $message)
    {
        $entry = $this->repository->find($message->entryId);
        if (!$entry) {
            return;
        }

        $this->manager->sendEntryDeletedNotification($entry);
    }
}