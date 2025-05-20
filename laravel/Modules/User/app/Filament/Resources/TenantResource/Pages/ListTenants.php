<?php

/**
 * Tenant List Management.
 */
declare(strict_types=1);

namespace Modules\User\Filament\Resources\TenantResource\Pages;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;
use Modules\User\Filament\Resources\TenantResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
<<<<<<< HEAD
use Modules\Xot\Filament\Resources\XotBaseResource\RelationManagers\XotBaseRelationManager;
=======
use Modules\Xot\Filament\Resources\XotBaseResource\RelationManager\XotBaseRelationManager;
>>>>>>> 0b525d2 (.)

class ListTenants extends XotBaseListRecords
{
    protected static string $resource = TenantResource::class;

    /**
     * Definisce le colonne della tabella per la lista tenant.
     */
<<<<<<< HEAD
    public function getTableColumns(): array
=======
    public function getListTableColumns(): array
>>>>>>> 0b525d2 (.)
    {
        return [
            'id' => TextColumn::make('id')
                ->searchable()
                ->sortable(),

            'name' => TextColumn::make('name')
                ->searchable(),

            'slug' => TextColumn::make('slug')
                ->default(function ($record) {
                    if ($record === null) {
                        return '';
                    }
                    $record->generateSlug();
                    $slug = Str::slug($record->name);
                    $record->slug = $slug;
                    $record->save();

                    return $slug;
                })
                ->sortable(),
        ];
    }
}
