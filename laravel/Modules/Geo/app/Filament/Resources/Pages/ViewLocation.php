<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\Pages;

use Modules\Geo\Filament\Resources\LocationResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

class ViewLocation extends XotBaseViewRecord
{
    protected static string $resource = LocationResource::class;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)

    protected function getInfolistSchema(): array
    {
        return [
            \Filament\Infolists\Components\Section::make('Informazioni Location')
                ->schema([
                    \Filament\Infolists\Components\TextEntry::make('name')
                        ->label('Nome'),
                    \Filament\Infolists\Components\TextEntry::make('address')
                        ->label('Indirizzo'),
                    \Filament\Infolists\Components\TextEntry::make('city')
                        ->label('Città'),
                    \Filament\Infolists\Components\TextEntry::make('postal_code')
                        ->label('CAP'),
                    \Filament\Infolists\Components\TextEntry::make('country')
                        ->label('Paese'),
                ])
                ->columns(2),
        ];
    }
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 008ac07 (Merge commit 'b61ed6096ef292b50d6f8751d28a19fbee500bc4' as 'laravel/Modules/Geo')
=======
>>>>>>> 3c5e1ea (.)
>>>>>>> 0e7ec50 (.)
=======
>>>>>>> 6f0eea5 (.)
}
