<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Filament\Resources;

use Filament\Tables;
use Filament\Tables\Table;
use Modules\TechPlanner\Filament\Resources\LegalRepresentativeResource\Pages;
use Modules\TechPlanner\Models\LegalRepresentative;
use Modules\Xot\Filament\Resources\XotBaseResource;

class LegalRepresentativeResource extends XotBaseResource
{
    protected static ?string $model = LegalRepresentative::class;

    public static function getFormSchema(): array
    {
        return [
            \Filament\Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            \Filament\Forms\Components\TextInput::make('surname')
                ->required()
                ->maxLength(255),
            \Filament\Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            \Filament\Forms\Components\TextInput::make('phone')
                ->tel()
                ->maxLength(255),
            \Filament\Forms\Components\TextInput::make('tax_code')
                ->maxLength(16),
            \Filament\Forms\Components\TextInput::make('role')
                ->maxLength(255),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLegalRepresentatives::route('/'),
            'create' => Pages\CreateLegalRepresentative::route('/create'),
            'edit' => Pages\EditLegalRepresentative::route('/{record}/edit'),
        ];
    }
}
