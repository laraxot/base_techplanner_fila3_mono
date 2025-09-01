<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Traits;

use Filament\Tables;
use Filament\Actions;
use Filament\Tables\Table;
use Webmozart\Assert\Assert;
use Filament\Tables\Actions\Action;
use Modules\UI\Enums\TableLayoutEnum;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use Modules\Xot\Actions\Model\TableExistsByModelClassActions;
use Modules\UI\Filament\Actions\Table\TableLayoutToggleTableAction;

/**
 * Trait HasXotTable.
 *
 * Provides enhanced table functionality with translations and optimized structure.
 *
 * @property TableLayoutEnum $layoutView
 */
trait HasXotTable
{
    use TransTrait;

    public TableLayoutEnum $layoutView = TableLayoutEnum::LIST;
    protected static bool $canReplicate = false;
    protected static bool $canView = true;
    protected static bool $canEdit = true;

    /**
     * @return array<Action|BulkAction|ActionGroup>
     */
    protected function getTableHeaderActions(): array
    {
        $actions = [
            // TableLayoutToggleTableAction::make(),
        ];

        if ($this->shouldShowAssociateAction()) {
            $actions['associate'] = Tables\Actions\AssociateAction::make()
                ->label('')
                ->icon('heroicon-o-paper-clip')
                ->tooltip(__('user::actions.associate_user'));
        }

        if ($this->shouldShowAttachAction()) {
            $actions['attach'] = Tables\Actions\AttachAction::make()
                ->label('')
                ->icon('heroicon-o-link')
                ->tooltip(__('user::actions.attach_user'))
                ->preloadRecordSelect();
        }

        return $actions;
    }

    /**
     * Determine whether to display the AssociateAction.
     */
    protected function shouldShowAssociateAction(): bool
    {
        // Custom logic for showing AssociateAction
        return false; // Change this to your condition
    }

    /**
     * Determine whether to display the AttachAction.
     */
    protected function shouldShowAttachAction(): bool
    {
        // @phpstan-ignore function.alreadyNarrowedType, function.alreadyNarrowedType, function.alreadyNarrowedType, function.alreadyNarrowedType
        return method_exists($this, 'getRelationship'); // Ensure relationship method exists
    }

    /**
     * Determine whether to display the DetachAction.
     */
    protected function shouldShowDetachAction(): bool
    {
        // Show DetachAction only if an associated relationship exists
        // @phpstan-ignore function.alreadyNarrowedType, function.alreadyNarrowedType, function.alreadyNarrowedType, function.alreadyNarrowedType, method.nonObject
        return method_exists($this, 'getRelationship') && $this->getRelationship()->exists();
    }

    protected function shouldShowReplicateAction(): bool
    {
        return static::$canReplicate;
    }

    protected function shouldShowViewAction(): bool
    {
        return static::$canView;
    }

    protected function shouldShowEditAction(): bool
    {
        return static::$canEdit;
    }

    /**
     * Get global header actions, optimized with tooltips instead of labels.
     *
     * @return array<Actions\Action>
     */
    protected function getHeaderActions(): array
    {
        return [
            'create' => Actions\CreateAction::make()
                    // ->label('')
                    // ->tooltip(static::trans('actions.create.tooltip'))
                    ->icon('heroicon-o-plus')
            // ->iconButton()
            // ->button()
            ,
        ];
    }

    /**
     * Get table columns for grid layout.
     *
     * @return array<Tables\Columns\Column|Stack|Tables\Columns\Layout\Split>
     */
    public function getGridTableColumns(): array
    {
        return [
            Stack::make($this->getListTableColumns()),
        ];
    }

    /**
     * Get list table columns.
     *
     * @return array<Tables\Columns\Column>
     */
    public function getListTableColumns(): array
    {
        return [];
    }

    public function getTableFiltersFormColumns(): int
    {
        $c = count($this->getTableFilters()) + 1;
        if ($c > 6) {
            return 6;
        }

        return $c;
    }

    public function getTableRecordTitleAttribute(): string
    {
        return 'name';
    }

    public function getTableHeading(): ?string
    {
        return static::trans('table.heading');
    }

    public function getTableEmptyStateActions(): array
    {
        return [];
    }

    /**
     * Define the main table structure.
     */
    public function table(Table $table): Table
    {
        if(! app(TableExistsByModelClassActions::class)->execute($this->getModelClass())){
            $this->notifyTableMissing();

            return $this->configureEmptyTable($table);
        }

        return $table
            ->recordTitleAttribute($this->getTableRecordTitleAttribute())
            ->heading($this->getTableHeading())
            ->columns($this->layoutView->getTableColumns())
            ->contentGrid($this->layoutView->getTableContentGrid())
            ->headerActions($this->getTableHeaderActions())
            ->filters($this->getTableFilters())
            ->filtersLayout(FiltersLayout::AboveContent)
            ->filtersFormColumns($this->getTableFiltersFormColumns())
            ->persistFiltersInSession()
            // @phpstan-ignore argument.type
            ->actions($this->getTableActions())
            ->bulkActions($this->getTableBulkActions())
            ->actionsPosition(ActionsPosition::BeforeColumns)
            ->emptyStateActions($this->getTableEmptyStateActions())
            ->striped();
        /*
        ->defaultSort(
            column: 'created_at',
            direction: 'Desc',
        )
        */
    }

    /**
     * Define table filters.
     *
     * @return array<Tables\Filters\Filter|TernaryFilter|BaseFilter>
     */
    protected function getTableFilters(): array
    {
        return []; // Implement any specific filters needed
    }

    /**
     * Define row-level actions with translations.
     *
     * @return array<Action|ActionGroup>
     */
    protected function getTableActions(): array
    {
        $actions = [];
        if ($this->shouldShowViewAction()) {
            $actions['view'] = Tables\Actions\ViewAction::make()
                ->iconButton()
                ->tooltip(__('user::actions.view'));
        }

        if ($this->shouldShowEditAction()) {
            $actions['edit'] = Tables\Actions\EditAction::make()
                ->iconButton()
                ->tooltip(__('user::actions.edit'));
        }

        if ($this->shouldShowReplicateAction()) {
            $actions['replicate'] = Tables\Actions\ReplicateAction::make()
                ->label('')
                ->tooltip(__('user::actions.replicate'))
                ->iconButton();
        }
        if (! $this->shouldShowDetachAction()) {
            $actions['delete'] = Tables\Actions\DeleteAction::make()
                ->tooltip(__('user::actions.delete'))
                ->iconButton()
            ;
        }

        if ($this->shouldShowDetachAction()) {
            $actions['detach'] = Tables\Actions\DetachAction::make()
                ->label('')
                ->tooltip(__('user::actions.detach'))
                ->icon('heroicon-o-link-slash')
                ->color('danger')
                ->requiresConfirmation();
        }

        return $actions;
    }

    /**
     * Define bulk actions with translations.
     *
     * @return array<BulkAction>
     */
    protected function getTableBulkActions(): array
    {
        return [
            DeleteBulkAction::make()
                ->label('')
                ->tooltip(__('user::actions.delete_selected'))
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation(),
        ];
    }

    /**
     * Get the model class from the relationship or throw an exception if not found.
     *
     * @throws \Exception
     */
    public function getModelClass(): string
    {
        // @phpstan-ignore function.alreadyNarrowedType, function.alreadyNarrowedType, function.alreadyNarrowedType, function.alreadyNarrowedType
        if (method_exists($this, 'getRelationship')) {
            // @phpstan-ignore classConstant.nonObject,  method.nonObject
            Assert::string($res = $this->getRelationship()->getModel()::class);

            return $res;
        }
        // @phpstan-ignore function.impossibleType, function.impossibleType
        if (method_exists($this, 'getModel')) {
            Assert::string($res = $this->getModel());

            return $res;
        }
        // if (method_exists($this, 'getMountedTableActionRecord')) {
        //    dddx($this->getMountedTableActionRecord());
        // }
        // if (method_exists($this, 'getTable')) {
        //    dddx( $this->getTable()->getModel());
        // }

        // ->model($this->getMountedTableActionRecord() ?? $this->getTable()->getModel())
        throw new \Exception('No model found in '.class_basename(__CLASS__).'::'.__FUNCTION__);
    }


    /**
     * Notify the user if the table is missing.
     */
    protected function notifyTableMissing(): void
    {
        $model_class = $this->getModelClass();
        Assert::isInstanceOf($model=app($model_class),Model::class);
        $tableName = $model->getTable();
        Notification::make()
            ->title(__('user::notifications.table_missing.title'))
            ->body(__('user::notifications.table_missing.body', ['table' => $tableName]))
            ->persistent()
            ->warning()
            ->send();
    }

    /**
     * Configure an empty table in case the actual table is missing.
     */
    protected function configureEmptyTable(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->whereNull('id'))
            ->columns([
                TextColumn::make('message')

                    ->default(__('user::fields.message.default'))
                    ->html(),
            ])
            ->headerActions([])
            ->actions([]);
    }
}
