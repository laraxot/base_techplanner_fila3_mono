<?php

declare(strict_types=1);

namespace Modules\Comment\Providers;

use Modules\Xot\Providers\XotBaseServiceProvider;

class CommentServiceProvider extends XotBaseServiceProvider
{
    public string $name = 'Comment';

    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;
}
