<?php

declare(strict_types=1);

namespace WireElements\Pro\Concerns;

use Illuminate\Support\Arr;
use WireElements\Pro\Contracts\BehavesAsInsert;
use WireElements\Pro\Contracts\BehavesAsModal;
use WireElements\Pro\Contracts\BehavesAsSlideOver;
use WireElements\Pro\Contracts\BehavesAsSpotlight;

trait ComponentTypeDetector
{
    public function config($key, $default = null)
    {
        $type = self::determineComponentType();
        $preset = config('wire-elements-pro.default');

        return Arr::get(
            array_merge(
                config("wire-elements-pro.presets.{$preset}.{$type}", []),
                config("wire-elements-pro.components.{$type}", [])
            ),
            $key,
            $default,
        );
    }

    private static function determineComponentType(): string
    {
        $interfaces = (new \ReflectionClass(static::class))->getInterfaceNames();

        if (in_array(BehavesAsModal::class, $interfaces, true)) {
            return 'modal';
        }

        if (in_array(BehavesAsSlideOver::class, $interfaces, true)) {
            return 'slide-over';
        }

        if (in_array(BehavesAsInsert::class, $interfaces, true)) {
            return 'insert';
        }

        if (in_array(BehavesAsSpotlight::class, $interfaces, true)) {
            return 'spotlight';
        }

        throw new \UnexpectedValueException('Could not determine component type.');
    }
}
