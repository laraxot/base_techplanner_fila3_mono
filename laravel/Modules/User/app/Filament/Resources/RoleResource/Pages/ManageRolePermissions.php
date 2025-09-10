<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\RoleResource\Pages;

use Filament\Forms;
<<<<<<< HEAD
use Filament\Forms\Form;
=======
>>>>>>> 9831a351 (.)
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\User\Filament\Resources\RoleResource;

<<<<<<< HEAD



use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;





=======
>>>>>>> 9831a351 (.)
class ManageRolePermissions extends ManageRelatedRecords
{
    protected static string $resource = RoleResource::class;

    protected static string $relationship = 'permissions';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Permissions';
    }

    public function getFormSchema(): array
<<<<<<< HEAD
{


    return [

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

      ];
}
=======
    {

        return [

            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

        ];
    }
>>>>>>> 9831a351 (.)

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AssociateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DissociateAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DissociateBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
