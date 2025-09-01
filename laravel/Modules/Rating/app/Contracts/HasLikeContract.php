<?php

declare(strict_types=1);

namespace Modules\Rating\Contracts;

/**
 * This interface allows models to receive replies.
 */
interface HasLikeContract
{
    /**
     * @param \Modules\Xot\Contracts\UserContract|null $user
     *
     * @return bool
     */
    public function isLikedBy($user);

    /**
     * @param \Modules\Xot\Contracts\UserContract|null $user
     *
     * @return void
     */
    public function likedBy($user);

    /**
     * @param \Modules\Xot\Contracts\UserContract|null $user
     *
     * @return void
     */
    public function dislikedBy($user);
}
