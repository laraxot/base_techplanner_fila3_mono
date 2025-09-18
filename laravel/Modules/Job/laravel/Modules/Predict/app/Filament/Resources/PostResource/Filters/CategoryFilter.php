<?php

/**
 * @see https://coderflex.com/blog/create-advanced-filters-with-filament
 */

declare(strict_types=1);

namespace Modules\Predict\Filament\Resources\PostResource\Filters;

use Filament\Tables\Filters\SelectFilter;

class CategoryFilter extends SelectFilter
{
    public static function getDefaultName(): ?string
    {
        return 'category';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->placeholder('Select a category to filter');
        // $this->relationship('category', 'name');
        $this->relationship('categories', 'title');
        // $this->searchable();
    }
}
