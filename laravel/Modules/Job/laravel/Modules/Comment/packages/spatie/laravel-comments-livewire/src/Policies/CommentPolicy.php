<?php

declare(strict_types=1);

namespace Spatie\LivewireComments\Policies;

use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Contracts\UserContract;
use Spatie\Comments\Models\Comment;

class CommentPolicy
{
    public function create(?UserContract $user): bool
    {
        return true;
    }

    public function update(?UserContract $user, Comment $comment): bool
    {
        if ($comment->getApprovingUsers()->contains($user)) {
            return true;
        }

        return $comment->madeBy($user);
    }

    public function delete(?UserContract $user, Comment $comment): bool
    {
        if ($comment->getApprovingUsers()->contains($user)) {
            return true;
        }

        return $comment->madeBy($user);
    }

    public function react(UserContract $user, Model $commentableModel): bool
    {
        return true;
    }

    public function see(?UserContract $user, Comment $comment): bool
    {
        if ($comment->isApproved()) {
            return true;
        }

        if (! $user) {
            return false;
        }

        if ($comment->madeBy($user)) {
            return true;
        }

        return $comment->getApprovingUsers()->contains($user);
    }

    public function approve(UserContract $user, Comment $comment): bool
    {
        return $comment->getApprovingUsers()->contains($user);
    }

    public function reject(UserContract $user, Comment $comment): bool
    {
        return $comment->getApprovingUsers()->contains($user);
    }
}
