<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\RoleResource\Pages;

<<<<<<< HEAD
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Pages\Actions\EditAction;
use Modules\User\Filament\Resources\RoleResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
=======
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Modules\User\Filament\Resources\RoleResource;
>>>>>>> 9831a351 (.)

class ViewRole extends \Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord
{
    protected static string $resource = RoleResource::class;
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    /**
     * @return array<\Filament\Infolists\Components\Component>
     */
    protected function getInfolistSchema(): array
    {
        return [
            Section::make()
                ->schema([
                    TextEntry::make('id'),
                    TextEntry::make('name'),
                    TextEntry::make('guard_name'),
                    TextEntry::make('team_id'),
                    TextEntry::make('uuid'),
                    TextEntry::make('created_at'),
                    TextEntry::make('updated_at'),
<<<<<<< HEAD
                ])
=======
                ]),
>>>>>>> 9831a351 (.)
        ];
    }
}
