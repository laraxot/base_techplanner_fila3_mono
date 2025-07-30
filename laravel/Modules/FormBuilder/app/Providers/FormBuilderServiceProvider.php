<?php

declare(strict_types=1);

namespace Modules\FormBuilder\Providers;

use Illuminate\Support\Facades\Blade;
use Modules\Xot\Providers\XotBaseServiceProvider;
use Nwidart\Modules\Traits\PathNamespace;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class FormBuilderServiceProvider extends XotBaseServiceProvider
{
    /**
     * Nome del modulo.
     */
    public string $name = 'FormBuilder';

    /**
     * Directory del provider.
     */
    protected string $module_dir = __DIR__;

    /**
     * Namespace del provider.
     */
    protected string $module_ns = __NAMESPACE__;
}
