<?php

declare(strict_types=1);

namespace App\Event\PostComment;

use App\Entity\PostComment;

class PostCommentEditedEvent
{
    public function __construct(public PostComment $comment)
    {
    }
}
