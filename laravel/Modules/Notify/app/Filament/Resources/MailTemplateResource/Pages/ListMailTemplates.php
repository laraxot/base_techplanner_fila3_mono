<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Resources\MailTemplateResource\Pages;

use Filament\Tables;
use Modules\Lang\Filament\Resources\Pages\LangBaseListRecords;
use Modules\Notify\Filament\Resources\MailTemplateResource;

class ListMailTemplates extends LangBaseListRecords
{
    protected static string $resource = MailTemplateResource::class;

    public function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('slug')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('mailable')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('subject')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('counter')
                ->searchable()
                ->sortable(),

        ];
    }
}
