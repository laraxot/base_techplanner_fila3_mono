<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\TeamResource\Pages;

<<<<<<< HEAD
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Modules\User\Filament\Resources\TeamResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
=======
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Modules\User\Filament\Resources\TeamResource;
>>>>>>> 9831a351 (.)

class ViewTeam extends \Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord
{
    // //
    protected static string $resource = TeamResource::class;

    /**
     * @return array<\Filament\Infolists\Components\Component>
     */
    public function getInfolistSchema(): array
    {
        return [
            Section::make()
                ->schema([
                    TextEntry::make('id'),
                    TextEntry::make('name'),
                    TextEntry::make('display_name'),
                    TextEntry::make('description'),
                    TextEntry::make('created_at'),
                    TextEntry::make('updated_at'),
<<<<<<< HEAD
                ])
        ];
    }

   
=======
                ]),
        ];
    }
>>>>>>> 9831a351 (.)
}
