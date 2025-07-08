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
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;

abstract class BaseListUsers extends XotBaseListRecords
{
    protected static string $resource = UserResource::class;

    /**
     * Get table columns for user records.
     *
     * @return array<string, \Filament\Tables\Columns\Column>
     */
    public function getTableColumns(): array
    {
        return [
            'name' => TextColumn::make('name')
                ->searchable(),
            'email' => TextColumn::make('email')
                ->searchable(),
        ];
    }

    /**
     * Get table filters for user records.
     *
     * @return array<Tables\Filters\BaseFilter>
     */
    public function getTableFilters(): array
    {
        return [
            // Filtri disabilitati per ora, abilitare se necessario
            /*
            Filter::make('verified')
                ->query(static fn (Builder $query): Builder => $query->whereNotNull('email_verified_at')),
            Filter::make('unverified')
                ->query(static fn (Builder $query): Builder => $query->whereNull('email_verified_at')),
            */
        ];
    }

    /**
     * Get table actions for user records.
     *
     * @return array<\Filament\Tables\Actions\Action|\Filament\Tables\Actions\ActionGroup>
     */
    public function getTableActions(): array
    {
        $actions = [
            ChangePasswordAction::make()
                ->tooltip('Cambio Password')
                ->iconButton(),
        ];
        
        // Add parent actions - filter to ensure type compatibility
        $parentActions = parent::getTableActions();
        foreach ($parentActions as $action) {
            if ($action instanceof \Filament\Tables\Actions\Action || $action instanceof \Filament\Tables\Actions\ActionGroup) {
                $actions[] = $action;
            }
        }
        /*
        // Add deactivate action
        $actions[] = Action::make('deactivate')
            ->tooltip(__('filament-actions::delete.single.label'))
            ->color('danger')
            ->icon('heroicon-o-trash')
            ->action(static fn (UserContract $user) => $user->delete());
        */   
        return $actions;
    }

    /**
     * Get header widgets for the user list page.
     *
     * @return array<class-string>
     */
    protected function getHeaderWidgets(): array
    {
        return [
            //UserOverview::class
        ];
    }

    /**
     * Get table bulk actions for user records.
     *
     * @return array<\Filament\Tables\Actions\BulkAction>
     */
    public function getTableBulkActions(): array
    {
        return [
            Tables\Actions\DeleteBulkAction::make(),
            //ExportBulkAction::make(),
        ];
    }
}
