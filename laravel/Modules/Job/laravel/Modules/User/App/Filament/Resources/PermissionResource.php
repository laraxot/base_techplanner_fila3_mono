<?php

/**
 * @see https://github.com/Althinect/filament-spatie-roles-permissions/tree/2.x
 * @see https://github.com/phpsa/filament-authentication/blob/main/src/resources/PermissionResource.php
 */

declare(strict_types=1);

namespace Modules\User\Filament\Resources;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Modules\User\Filament\Resources\PermissionResource\Pages\CreatePermission;
use Modules\User\Filament\Resources\PermissionResource\Pages\EditPermission;
use Modules\User\Filament\Resources\PermissionResource\Pages\ListPermissions;
use Modules\User\Filament\Resources\PermissionResource\Pages\ViewPermission;
use Modules\User\Filament\Resources\PermissionResource\RelationManager\RoleRelationManager;
use Modules\User\Models\Permission;
use Modules\User\Models\Role;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Webmozart\Assert\Assert;

class PermissionResource extends XotBaseResource
{
    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    // public static function shouldRegisterNavigation(): bool
    // {
    //    return config('filament-spatie-roles-permissions.should_register_on_navigation.permissions', true);
    // }

    // public static function getModel(): string
    // {
    //    return config('permission.models.permission', Permission::class);
    // }

    // public static function getLabel(): string
    // {
    //    return __('filament-spatie-roles-permissions::filament-spatie.section.permission');
    // }

    // public static function getNavigationGroup(): ?string
    // {
    //    return __(config('filament-spatie-roles-permissions.navigation_section_group', 'filament-spatie-roles-permissions::filament-spatie.section.roles_and_permissions'));
    // }

    // public static function getPluralLabel(): string
    // {
    //    return __('filament-spatie-roles-permissions::filament-spatie.section.permissions');
    // }

    public static function getFormSchema(): array
    {
        Assert::isArray($guard_names = config('filament-spatie-roles-permissions.guard_names'));
        Assert::string($default_guard_name = config('filament-spatie-roles-permissions.default_guard_name'));
        Assert::boolean($preload_roles = config('filament-spatie-roles-permissions.preload_roles', true));

        return [
            Section::make()
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->required(),
                        Select::make('guard_name')
                            ->options($guard_names)
                            ->default($default_guard_name)
                            ->required(),
                        Select::make('roles')
                            ->multiple()
                            ->relationship('roles', 'name')
                            ->preload($preload_roles),
                    ]),
                ]),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RoleRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPermissions::route('/'),
            'create' => CreatePermission::route('/create'),
            'edit' => EditPermission::route('/{record}/edit'),
            'view' => ViewPermission::route('/{record}'),
        ];
    }

    public static function syncPermissions(Permission $permission, array $data): void
    {
        if (! isset($data['roles'])) {
            $permission->roles()->detach();

            return;
        }

        $permission->roles()->sync($data['roles']);
    }
}
