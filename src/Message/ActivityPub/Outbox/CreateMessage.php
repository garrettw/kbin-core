<?php declare(strict_types=1);

namespace App\Message\ActivityPub\Outbox;

use App\Message\AsyncMessageInterface;

class CreateMessage implements AsyncMessageInterface
{
    public function __construct(public int $id, public string $type)
    {
    }
}