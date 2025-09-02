<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Resources\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager as FilamentRelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Modules\Xot\Filament\Traits\HasXotTable;
use Webmozart\Assert\Assert;

/**
 * @property class-string<Model> $resource
 */
abstract class XotBaseRelationManager extends FilamentRelationManager
{
    use HasXotTable;

    protected static string $relationship = '';

    /** @var class-string<XotBaseResource> */
    protected static string $resourceClass;

    public static function getModuleName(): string
    {
        $class = static::class;
        $arr = explode('\\', $class);
        $module_name = $arr[1];

        return $module_name;
    }

    final public function form(Form $form): Form
    {
        return $form->schema(
            $this->getFormSchema()
        );
    }

    public function getFormSchema(): array
    {
        return $this->getResource()::getFormSchema();
    }

    /**
     * Get table columns from the resource's index page
     */
    public function getTableColumns(): array
    {
        $index = Arr::get($this->getResource()::getPages(), 'index');
        if (! $index) {
            return [];
        }
        
        /** @phpstan-ignore method.nonObject */
        $index_page = $index->getPage();

        if (! method_exists($index_page, 'getTableColumns')) {
            return [];
        }
        
        /** @phpstan-ignore argument.type */
        $res = app($index_page)->getTableColumns();

        return $res;
    }

    /**
     * Get table actions with dynamic visibility based on resource permissions
     */
    public function getTableActions(): array
    {
        $actions = [];
        $resource = $this->getResource();
        
        if (method_exists($resource, 'canEdit')) {
            $actions['edit'] = Tables\Actions\EditAction::make()
                ->visible(fn (Model $record): bool => $resource::canEdit($record));
        }

        if (method_exists($resource, 'canDetach')) {
            $actions['detach'] = Tables\Actions\DetachAction::make()
                ->visible(fn (Model $record): bool => $resource::canDetach($record));
        }
        
        if (method_exists($resource, 'canDelete')) {
            $actions['delete'] = Tables\Actions\DeleteAction::make()
                ->visible(fn (Model $record): bool => $resource::canDelete($record));
        }

        return $actions;
    }

    public function getTableBulkActions(): array
    {
        return [
            // Tables\Actions\DeleteBulkAction::make(),
            Tables\Actions\DetachBulkAction::make(),
        ];
    }

    /**
     * Get table header actions with dynamic visibility based on resource permissions
     */
    public function getTableHeaderActions(): array
    {
        $actions = [];
        $resource = $this->getResource();
        
        if (method_exists($resource, 'canAttach')) {
            $actions['attach'] = Tables\Actions\AttachAction::make()
                ->icon('heroicon-o-link')
                ->visible(fn (?Model $record): bool => $resource::canAttach());
        }

        if (method_exists($resource, 'canCreate')) {
            $actions['create'] = Tables\Actions\CreateAction::make()
                ->visible(fn (?Model $record): bool => $resource::canCreate());
        }

        return $actions;
    }

    public function getTableFilters(): array
    {
        return [];
    }

    public function getResource(): string
    {
        $resource = static::$resource;
        Assert::classExists($resource);
        Assert::isAOf($resource, XotBaseResource::class);

        return $resource;
    }

    public function getRelationship(): \Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Eloquent\Builder
    {
        return parent::getRelationship();
    }
}
