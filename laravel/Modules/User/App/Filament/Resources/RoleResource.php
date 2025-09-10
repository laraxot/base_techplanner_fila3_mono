<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources;

use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\Page;
use Modules\User\Filament\Resources\RoleResource\Pages;
use Modules\User\Filament\Resources\RoleResource\RelationManagers;
use Modules\Xot\Filament\Resources\XotBaseResource;

class RoleResource extends XotBaseResource
{
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    public static function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('guard_name')
                ->default('web')
                ->required()
                ->maxLength(255),
            \Filament\Forms\Components\Select::make('permissions')
                ->multiple()
                ->relationship('permissions', 'name')
                ->preload(),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\UsersRelationManager::class,
            RelationManagers\PermissionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'view' => Pages\ViewRole::route('/{record}'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
            'permissions' => Pages\ManageRolePermissions::route('/{record}/permissions'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewRole::class,
            Pages\EditRole::class,
            // Pages\EditCustomerContact::class,
            // Pages\ManageCustomerAddresses::class,
            Pages\ManageRolePermissions::class,
            // Pages\ManageCustomerPayments::class,
        ]);
    }
}
