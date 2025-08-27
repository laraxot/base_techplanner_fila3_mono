<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Resources\PageContentResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Modules\Lang\Filament\Resources\Pages\LangBaseViewRecord;
use Modules\Cms\Filament\Resources\PageContentResource;

class ViewPageContent extends LangBaseViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = PageContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }

    /**
     * @return array<int|string,\Filament\Infolists\Components\Component>
     */
    protected function getInfolistSchema(): array
    {
        return [
            \Filament\Infolists\Components\Section::make('Page Content Details')
                ->schema([
                    \Filament\Infolists\Components\Grid::make(2)
                        ->schema([
                            \Filament\Infolists\Components\TextEntry::make('title')
                                ->label('Title'),
                            \Filament\Infolists\Components\TextEntry::make('type')
                                ->label('Type')
                                ->badge(),
                            \Filament\Infolists\Components\TextEntry::make('status')
                                ->label('Status')
                                ->badge(),
                            \Filament\Infolists\Components\TextEntry::make('lang')
                                ->label('Language'),
                        ]),
                    \Filament\Infolists\Components\TextEntry::make('txt')
                        ->label('Content')
                        ->html()
                        ->columnSpan(2),
                ])
                ->collapsible(),

            \Filament\Infolists\Components\Section::make('Metadata')
                ->schema([
                    \Filament\Infolists\Components\Grid::make(2)
                        ->schema([
                            \Filament\Infolists\Components\TextEntry::make('created_at')
                                ->label('Created At')
                                ->dateTime(),
                            \Filament\Infolists\Components\TextEntry::make('updated_at')
                                ->label('Updated At')
                                ->dateTime(),
                        ]),
                ])
                ->collapsible(),
        ];
    }
}
