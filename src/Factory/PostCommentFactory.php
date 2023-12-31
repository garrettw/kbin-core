<?php

declare(strict_types=1);

namespace App\Factory;

use App\DTO\PostCommentDto;
use App\Entity\PostComment;
use App\Entity\User;

class PostCommentFactory
{
    public function createFromDto(PostCommentDto $dto, User $user): PostComment
    {
        return new PostComment(
            $dto->body,
            $dto->post,
            $user,
            $dto->parent,
            $dto->ip
        );
    }

    public function createDto(PostComment $comment): PostCommentDto
    {
        $dto = new PostCommentDto();
        $dto->magazine = $comment->magazine;
        $dto->post = $comment->post;
        $dto->user = $comment->user;
        $dto->body = $comment->body;
        $dto->lang = $comment->lang;
        $dto->isAdult = $comment->isAdult;
        $dto->uv = $comment->countUpVotes();
        $dto->visibility = $comment->visibility;
        $dto->createdAt = $comment->createdAt;
        $dto->lastActive = $comment->lastActive;
        $dto->setId($comment->getId());

        return $dto;
    }
}
