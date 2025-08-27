<?php

declare(strict_types=1);

namespace Modules\Employee\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Employee\Models\WorkHour;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Modules\Employee\Models\Employee;

class WorkHourResource extends XotBaseResource
{
    protected static ?string $model = WorkHour::class;

    /**
     * @return array<string|int,\Filament\Forms\Components\Component>
     */
    public static function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make('Time Entry Details')
                ->schema([
                   
                ])
                ->columns(2),
        ];
    }


    /**
     * @return array<class-string<\Filament\Widgets\Widget>>
     */
    public static function getHeaderWidgets(): array
    {
        return [];
    }
}
