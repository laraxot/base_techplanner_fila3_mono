<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\Pages;

use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Query\Builder;
use Modules\User\Filament\Actions\ChangePasswordAction;
use Modules\User\Filament\Resources\UserResource;
use Modules\User\Filament\Resources\UserResource\Widgets\UserOverview;
use Modules\Xot\Contracts\UserContract;

class ListUsers extends BaseListUsers
{
    protected static string $resource = UserResource::class;

    public function getTableColumns(): array
    {
        return [
            // 'id' => TextColumn::make('id'),
            'name' => TextColumn::make('name')
                ->searchable(),
            'email' => TextColumn::make('email')
                ->searchable(),
            // 'email_verified_at' => TextColumn::make('email_verified_at')
            //    ->dateTime(),
            // 'created_at' => TextColumn::make('created_at')
            //    ->dateTime(),
        ];
    }

    /**
     * @return array<Tables\Filters\BaseFilter>
     */
    public function getTableFilters(): array
    {
        return [
            /*
            Filter::make('verified')
                ->query(static fn (Builder $query): Builder => $query->whereNotNull('email_verified_at')),
            Filter::make('unverified')
                ->query(static fn (Builder $query): Builder => $query->whereNull('email_verified_at')),
            */
        ];
    }

    /**
     * @phpstan-ignore-next-line
     */
    public function getTableActions(): array
    {
        /** @phpstan-ignore-next-line */
        return [
            'change_password' => ChangePasswordAction::make()
                ->tooltip('Cambio Password')
                ->iconButton(),
            ...parent::getTableActions(),
            'deactivate' => Action::make('deactivate')
                ->tooltip(__('filament-actions::delete.single.label'))
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->action(static fn (UserContract $user) => $user->delete()),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            UserOverview::class,
        ];
    }

    /**
     * @return array<string, Tables\Actions\BulkAction>
     */
    public function getTableBulkActions(): array
    {
        return [
            'delete' => Tables\Actions\DeleteBulkAction::make(),
            'export' => ExportBulkAction::make(),
        ];
    }
}
