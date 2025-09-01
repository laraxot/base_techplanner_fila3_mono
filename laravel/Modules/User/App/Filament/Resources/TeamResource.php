<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources;

use Filament\Forms\Components\TextInput;
use Modules\User\Filament\Resources\TeamResource\Pages\CreateTeam;
use Modules\User\Filament\Resources\TeamResource\Pages\EditTeam;
use Modules\User\Filament\Resources\TeamResource\Pages\ListTeams;
use Modules\User\Filament\Resources\TeamResource\Pages\ViewTeam;
use Modules\User\Filament\Resources\TeamResource\RelationManagers\UsersRelationManager;
use Modules\Xot\Datas\XotData;
use Modules\Xot\Filament\Resources\XotBaseResource;

class TeamResource extends XotBaseResource
{
    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Teams';

    protected static ?string $slug = 'teams';

    protected static ?string $navigationGroup = 'Admin';

    public static function getModel(): string
    {
        $xot = XotData::make();

        return $xot->getTeamClass();
    }

    public static function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('display_name')
                ->maxLength(255),
            TextInput::make('description')
                ->maxLength(255),
            \Filament\Forms\Components\Select::make('owner_id')
                ->relationship('owner', 'name')
                ->searchable()
                ->preload()
                ->required(),
        ];
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTeams::route('/'),
            'create' => CreateTeam::route('/create'),
            'view' => ViewTeam::route('/{record}'),
            'edit' => EditTeam::route('/{record}/edit'),
        ];
    }
}
