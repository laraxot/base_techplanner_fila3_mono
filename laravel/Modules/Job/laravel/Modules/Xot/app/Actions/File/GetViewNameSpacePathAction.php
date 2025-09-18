<?php

namespace Modules\Xot\Actions\File;

use Illuminate\Support\Arr;
use Illuminate\View\Factory;
use InvalidArgumentException;
use Illuminate\Support\Facades\View;

class GetViewNameSpacePathAction
{
    

    /**
     * Metodo statico per utilizzo rapido
     *
     * @param string $namespace Namespace della vista
     * @return string Path completo della vista
     */
    public static function execute(string $namespace): string
    {
        $finder = View::getFinder();
        $viewHints = [];
        if (method_exists($finder, 'getHints')) {
            $viewHints = $finder->getHints();
        }
        $path= Arr::get($viewHints, $namespace.'.0');
        return $path;
    }
}