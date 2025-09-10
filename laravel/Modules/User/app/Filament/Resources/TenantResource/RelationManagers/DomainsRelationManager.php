<?php

/**
 * --.
 */
declare(strict_types=1);

namespace Modules\User\Filament\Resources\TenantResource\RelationManagers;

use Filament\Forms;
<<<<<<< HEAD
use Filament\Forms\Form;
=======
>>>>>>> 9831a351 (.)
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;

<<<<<<< HEAD








=======
>>>>>>> 9831a351 (.)
class DomainsRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'domains';

    /**
     * @return array<string, \Filament\Forms\Components\Component>
     */
    public function getFormSchema(): array
    {
        return [
            'domain' => Forms\Components\TextInput::make('domain')
                ->required()
                ->prefix('http(s)://')
                ->suffix('.'.request()->getHost())
                ->maxLength(255),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('domain')
            ->columns(
                [
                    Tables\Columns\TextColumn::make('domain'),
                    Tables\Columns\TextColumn::make('full-domain')->getStateUsing(static fn ($record) => Str::of($record->domain)->append('.')->append(request()->getHost())),
                ]
            )
            ->filters(
                [
                ]
            )
            ->headerActions(
                [
                    Tables\Actions\CreateAction::make(),
                ]
            )
            ->actions(
                [
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]
            )
            ->bulkActions(
                [
                    Tables\Actions\BulkActionGroup::make(
                        [
                            Tables\Actions\DeleteBulkAction::make(),
                        ]
                    ),
                ]
            );
    }
}
