<?php declare(strict_types = 1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class EntryCommentReplyNotification extends Notification
{
    /**
     * @ORM\JoinColumn(onDelete="cascade")
     * @ORM\ManyToOne(targetEntity="EntryComment", inversedBy="notifications", cascade={"remove"})
     */
    public ?EntryComment $entryComment;

    public function __construct(User $receiver, EntryComment $comment)
    {
        parent::__construct($receiver);

        $this->entryComment = $comment;
    }

    public function getSubject(): EntryComment
    {
        return $this->entryComment;
    }

    public function getComment(): EntryComment
    {
        return $this->entryComment;
    }

    public function getType(): string
    {
        return 'entry_comment_reply_notification';
    }
}
