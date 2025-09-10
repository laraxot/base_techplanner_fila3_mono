<?php

declare(strict_types=1);

namespace Modules\Employee\Filament\Resources\WorkHourResource\Pages;

<<<<<<< HEAD
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Modules\Employee\Filament\Resources\WorkHourResource;
use Modules\Employee\Models\WorkHour;
=======
use Modules\Employee\Filament\Resources\WorkHourResource;
>>>>>>> cda86dd (.)
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListWorkHours extends XotBaseListRecords
{
    protected static string $resource = WorkHourResource::class;

    // getTableColumns() method removed - XotBaseListRecords handles this automatically
}
