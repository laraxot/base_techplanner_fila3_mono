<?php

declare(strict_types=1);

namespace Spatie\LivewireComments\Policies;

use Modules\Xot\Contracts\UserContract;
use Spatie\Comments\Models\Reaction;

class ReactionPolicy
{
    public function delete(UserContract $commentator, Reaction $reaction): bool
    {
        return $reaction->madeBy($commentator);
    }
}
