<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\BaseProfileResource\Pages;

use Filament\Actions;
use Filament\Infolists\Components;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Modules\User\Filament\Resources\BaseProfileResource;

<<<<<<< HEAD
class ViewProfile extends ViewRecord
=======
class ViewProfile extends \Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord
>>>>>>> 96f269357d1a785a36860a85f377f9e5c58e50b8
{
    protected static string $resource = BaseProfileResource::class;

    /*
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
    */

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make()
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(2)
                                ->schema([
                                    Components\Group::make([
                                        TextEntry::make('email'),
                                        TextEntry::make('first_name'),
                                        TextEntry::make('last_name'),
                                        TextEntry::make('created_at')
                                            ->badge()
                                            ->date()
                                            ->color('success'),
                                    ]),
                                    /*
                                Components\Group::make([
                                    Components\TextEntry::make('author.name'),
                                    Components\TextEntry::make('category.name'),
                                    Components\TextEntry::make('tags')
                                        ->badge()
                                        ->getStateUsing(fn () => ['one', 'two', 'three', 'four']),
                                ]),
                                */
                                ]),
                            Components\ImageEntry::make('image')
                                ->hiddenLabel()
                                ->grow(false),
                        ])->from('lg'),
                    ]),
                Components\Section::make('Content')
                    ->schema([
                        TextEntry::make('content')
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),
            ]);
    }
}
