<?php

declare(strict_types=1);


namespace Modules\Xot\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Dashboard as FilamentDashboard;

abstract class XotBaseDashboard extends FilamentDashboard
{
    use FilamentDashboard\Concerns\HasFiltersForm;

    protected static null|int $navigationSort = 1;
    protected bool $persistsFiltersInSession = true;

    final public function filtersForm(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema($this->getFiltersFormSchema())->columns(3),
        ]);
    }

    public function getFiltersFormSchema(): array
    {
        return [];
    }
}
