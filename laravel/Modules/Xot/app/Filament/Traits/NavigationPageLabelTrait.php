<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Traits;

use Illuminate\Contracts\Support\Htmlable;

trait NavigationPageLabelTrait
{
    use TransTrait;

    /**
     * Get the model label for navigation.
     * This method must be static to be compatible with XotBasePage.
     */
    public static function getModelLabel(): string
    {
        return static::trans('navigation.name');
    }

    /**
     * Get the plural model label for navigation.
     * This method must be static to be compatible with XotBasePage.
     */
    public static function getPluralModelLabel(): string
    {
        return static::trans('navigation.plural');
    }

    /**
     * Get the page title.
     * This method must be an instance method to be compatible with XotBasePage.
     */
    public function getTitle(): string
    {
        return static::trans('title');
    }

    /**
     * Get the page heading.
     * This method must be an instance method to be compatible with XotBasePage.
     */
    public function getHeading(): string
    {
        return static::trans('heading');
    }

    /**
     * Get the page sub-heading.
     * This method must be an instance method to be compatible with XotBasePage.
     */
    public function getSubHeading(): string
    {
        return static::trans('sub_heading');
    }
}
