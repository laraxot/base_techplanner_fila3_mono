<?php

namespace Spatie\Comments\Actions;

use Spatie\Comments\Events\CommentApprovedEvent;
use Spatie\Comments\Models\Comment;
use Spatie\Comments\Support\Config;

class ApproveCommentAction
{
    public function execute(Comment $comment): Comment
    {
        if ($comment->isApproved()) {
            return $comment;
        }

        $comment->update([
            'approved_at' => now(),
        ]);

        event(new CommentApprovedEvent($comment));

        if (Config::notificationsEnabled()) {
            Config::sendNotificationsForApprovedCommentAction()->execute($comment);
        }

        return $comment;
    }
}
