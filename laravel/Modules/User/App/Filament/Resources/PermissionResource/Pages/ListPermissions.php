<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\PermissionResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Collection;
use Modules\User\Filament\Resources\PermissionResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Webmozart\Assert\Assert;

class ListPermissions extends XotBaseListRecords
{
    protected static string $resource = PermissionResource::class;

    /**
     * @return array<string, Tables\Columns\Column>
     */
    public function getListTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->searchable()
                ->sortable(),
            'name' => TextColumn::make('name')
                ->searchable()
                ->sortable()
                ->wrap(),
            'guard_name' => TextColumn::make('guard_name')
                ->searchable()
                ->sortable(),
            'roles_count' => TextColumn::make('roles_count')
                ->counts('roles')
                ->numeric()
                ->sortable(),
            'created_at' => TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
        ];
    }

    /**
     * @return array<string, Tables\Filters\BaseFilter>
     */
    public function getTableFilters(): array
    {
        return [
            'guard_name' => Tables\Filters\SelectFilter::make('guard_name')
                ->options([
                    'web' => 'Web',
                    'api' => 'API',
                    'sanctum' => 'Sanctum',
                ])
                ->multiple(),
        ];
    }

    /**
     * @return array<string, Tables\Actions\Action|Tables\Actions\ActionGroup>
     */
    public function getTableActions(): array
    {
        return [
            'view' => Tables\Actions\ViewAction::make(),
            'edit' => Tables\Actions\EditAction::make(),
            'delete' => Tables\Actions\DeleteAction::make(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    /**
     * @return array<string, BulkAction>
     */
    public function getTableBulkActions(): array
    {
        Assert::classExists($roleModel = config('permission.models.role'));

        return [
            'delete' => DeleteBulkAction::make(),
            'attach_role' => BulkAction::make('Attach Role')
                ->action(
                    static function (Collection $collection, array $data): void {
                        foreach ($collection as $record) {
                            Assert::isInstanceOf($record, \Modules\Xot\Datas\XotData::make()->getUserClass(), '['.__LINE__.']['.__CLASS__.']');
                            $record->roles()->sync($data['role']);
                            $record->save();
                        }
                    }
                )
                ->form([
                    Select::make('role')
                        ->options($roleModel::query()->pluck('name', 'id'))
                        ->required(),
                ])
                ->deselectRecordsAfterCompletion(),
        ];
    }
}
