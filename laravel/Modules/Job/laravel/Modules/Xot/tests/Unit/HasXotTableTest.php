<?php

namespace Modules\Xot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Mockery;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Modules\Xot\Filament\Traits\HasXotTable;
use Filament\Tables\Filters\Indicator;
use Filament\Forms\Form;
use Filament\Forms\Components\Group;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Grouping\Group as TableGroup;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class HasXotTableTest extends TestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * Test the table method with all methods implemented.
     *
     * @return void
     */
    public function testTableMethodWithAllMethodsImplemented(): void
    {
        // Create mock object that uses HasXotTable trait
        $mock = Mockery::mock(HasTableWithXot::class);

        // Expect getTableHeaderActions to be called
        $mock->shouldReceive('getTableHeaderActions')
            ->once()
            ->andReturn([]);

        // Expect getTableActions to be called
        $mock->shouldReceive('getTableActions')
            ->once()
            ->andReturn([]);

        // Expect getTableBulkActions to be called
        $mock->shouldReceive('getTableBulkActions')
            ->once()
            ->andReturn([]);

        // Other required method stubs
        $mock->shouldReceive('getModelClass')
            ->andReturn(DummyModel::class);
        $mock->shouldReceive('getTableRecordTitleAttribute')
            ->andReturn('name');
        $mock->shouldReceive('getTableHeading')
            ->andReturn('Test Table');
        $mock->shouldReceive('getTableFilters')
            ->andReturn([]);
        $mock->shouldReceive('getTableFiltersFormColumns')
            ->andReturn(1);
        $mock->shouldReceive('getTableEmptyStateActions')
            ->andReturn([]);

        // Create a mock for Table
        $tableMock = Mockery::mock(Table::class);
        $tableMock->shouldReceive('recordTitleAttribute')->andReturnSelf();
        $tableMock->shouldReceive('heading')->andReturnSelf();
        $tableMock->shouldReceive('columns')->andReturnSelf();
        $tableMock->shouldReceive('contentGrid')->andReturnSelf();
        $tableMock->shouldReceive('filters')->andReturnSelf();
        $tableMock->shouldReceive('filtersLayout')->andReturnSelf();
        $tableMock->shouldReceive('filtersFormColumns')->andReturnSelf();
        $tableMock->shouldReceive('persistFiltersInSession')->andReturnSelf();
        $tableMock->shouldReceive('headerActions')->andReturnSelf();
        $tableMock->shouldReceive('actions')->andReturnSelf();
        $tableMock->shouldReceive('bulkActions')->andReturnSelf();
        $tableMock->shouldReceive('actionsPosition')->andReturnSelf();
        $tableMock->shouldReceive('emptyStateActions')->andReturnSelf();
        $tableMock->shouldReceive('striped')->andReturnSelf();

        // Call the table method
        $result = $mock->table($tableMock);

        // Assert the result is a Table instance
        $this->assertSame($tableMock, $result);
    }

    /**
     * Test the table method without any of the optional methods implemented.
     *
     * @return void
     */
    public function testTableMethodWithNoOptionalMethodsImplemented(): void
    {
        // Create mock object that uses HasXotTable trait but doesn't implement optional methods
        $mock = Mockery::mock(HasTableWithoutOptionalMethods::class);

        // Other required method stubs
        $mock->shouldReceive('getModelClass')
            ->andReturn(DummyModel::class);
        $mock->shouldReceive('getTableRecordTitleAttribute')
            ->andReturn('name');
        $mock->shouldReceive('getTableHeading')
            ->andReturn('Test Table');
        $mock->shouldReceive('getTableFilters')
            ->andReturn([]);
        $mock->shouldReceive('getTableFiltersFormColumns')
            ->andReturn(1);
        $mock->shouldReceive('getTableEmptyStateActions')
            ->andReturn([]);

        // Create a mock for Table
        $tableMock = Mockery::mock(Table::class);
        $tableMock->shouldReceive('recordTitleAttribute')->andReturnSelf();
        $tableMock->shouldReceive('heading')->andReturnSelf();
        $tableMock->shouldReceive('columns')->andReturnSelf();
        $tableMock->shouldReceive('contentGrid')->andReturnSelf();
        $tableMock->shouldReceive('filters')->andReturnSelf();
        $tableMock->shouldReceive('filtersLayout')->andReturnSelf();
        $tableMock->shouldReceive('filtersFormColumns')->andReturnSelf();
        $tableMock->shouldReceive('persistFiltersInSession')->andReturnSelf();
        // headerActions, actions, and bulkActions should NOT be called
        $tableMock->shouldReceive('actionsPosition')->andReturnSelf();
        $tableMock->shouldReceive('emptyStateActions')->andReturnSelf();
        $tableMock->shouldReceive('striped')->andReturnSelf();

        // Call the table method
        $result = $mock->table($tableMock);

        // Assert the result is a Table instance
        $this->assertSame($tableMock, $result);
    }
}

trait HasTableWithXot
{
    use InteractsWithForms;
    use HasXotTable;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([])
            ->statePath('data');
    }

    public function getLayoutView(): string
    {
        return 'layout.view';
    }

    public function getTable(): Table
    {
        return Mockery::mock(Table::class);
    }

    public function getTablePage(): int
    {
        return 1;
    }

    public function getTableRecordsPerPage(): int|string|null
    {
        return 10;
    }

    public function getTableSortColumn(): ?string
    {
        return null;
    }

    public function getTableSortDirection(): ?string
    {
        return null;
    }

    public function getTableFilters(): array
    {
        return [];
    }

    public function getTableFiltersForm(): Form
    {
        return Form::make([]);
    }

    public function getTableFilterState(string $name): ?array
    {
        return [];
    }

    public function getTableGrouping(): ?Group
    {
        return null;
    }

    public function getTableSearchIndicator(): Indicator
    {
        return new Indicator('search', 'value');
    }

    public function getTableColumnSearchIndicators(): array
    {
        return [];
    }

    public function getTableColumnToggleForm(): Form
    {
        return Form::make([]);
    }

    public function getTableRecords(): EloquentCollection|CursorPaginator
    {
        return new EloquentCollection([]);
    }

    public function getTableRecord(?string $key): ?Model
    {
        return null;
    }

    public function getTableRecordKey(Model $record): string
    {
        return (string) $record->getKey();
    }
}

/**
 * Dummy class without the optional methods.
 */
class HasTableWithoutOptionalMethods implements HasTable, HasForms
{
    use HasTableWithXot;

    public function getLayoutView(): mixed
    {
        $mock = Mockery::mock();
        $mock->shouldReceive('getTableColumns')->andReturn([]);
        $mock->shouldReceive('getTableContentGrid')->andReturn([]);
        return $mock;
    }

    public function getTable(): Table
    {
        return Mockery::mock(Table::class);
    }

    public function getTablePage(): int
    {
        return 1;
    }

    public function getTableRecordsPerPage(): int
    {
        return 10;
    }

    public function getTableSortColumn(): ?string
    {
        return null;
    }

    public function getTableSortDirection(): ?string
    {
        return null;
    }

    public function getTableFilters(): array
    {
        return [];
    }

    public function getTableFiltersForm(): Form
    {
        return Form::make([]);
    }

    public function getTableFilterState(string $name): ?array
    {
        return [];
    }

    public function getTableGrouping(): ?Group
    {
        return null;
    }

    public function getTableSearchIndicator(): Indicator
    {
        return new Indicator();
    }

    public function getTableColumnSearchIndicators(): array
    {
        return [];
    }

    public function getTableColumnToggleForm(): Form
    {
        return Form::make([]);
    }

    public function getTableRecords(): EloquentCollection|CursorPaginator
    {
        return new EloquentCollection([]);
    }

    public function getTableRecord(?string $key): ?Model
    {
        return null;
    }

    public function getTableRecordKey(Model $record): string
    {
        return (string) $record->getKey();
    }

    public function getSelectedTableRecords(bool $shouldFetchSelectedRecords = true): EloquentCollection|Collection
    {
        return new EloquentCollection([]);
    }

    public function getAllTableRecordsCount(): int
    {
        return 0;
    }

    public function getAllSelectableTableRecordsCount(): int
    {
        return 0;
    }

    public function getAllSelectableTableRecordKeys(): array
    {
        return [];
    }

    public function getTableQueryForExport(): mixed
    {
        return null;
    }

    public function getFilteredTableQuery(): mixed
    {
        return null;
    }

    public function getFilteredSortedTableQuery(): mixed
    {
        return null;
    }

    public function getAllTableSummaryQuery(): mixed
    {
        return null;
    }

    public function getPageTableSummaryQuery(): mixed
    {
        return null;
    }

    public function getMountedTableAction(): ?string
    {
        return null;
    }

    public function getMountedTableActionForm(): mixed
    {
        return null;
    }

    public function getMountedTableActionRecord(): mixed
    {
        return null;
    }

    public function getMountedTableActionRecordKey(): mixed
    {
        return null;
    }

    public function getMountedTableBulkAction(): ?string
    {
        return null;
    }

    public function getMountedTableBulkActionForm(): mixed
    {
        return null;
    }

    public function getActiveTableLocale(): ?string
    {
        return null;
    }

    public function isTableLoaded(): bool
    {
        return true;
    }

    public function isTableReordering(): bool
    {
        return false;
    }

    public function hasTableSearch(): bool
    {
        return false;
    }

    public function isTableColumnToggledHidden(): bool
    {
        return false;
    }

    public function callMountedTableAction(): mixed
    {
        return null;
    }

    public function callTableColumnAction(): mixed
    {
        return null;
    }

    public function deselectAllTableRecords(): void
    {
    }

    public function mountTableAction(): void
    {
    }

    public function mountTableBulkAction(): void
    {
    }

    public function mountedTableActionRecord(): mixed
    {
        return null;
    }

    public function replaceMountedTableAction(): void
    {
    }

    public function replaceMountedTableBulkAction(): void
    {
    }

    public function resetTableSearch(): void
    {
    }

    public function resetTableColumnSearch(): void
    {
    }

    public function toggleTableReordering(): void
    {
    }

    public function parseTableFilterName(): string
    {
        return '';
    }

    public function makeFilamentTranslatableContentDriver(): mixed
    {
        return null;
    }
}

/**
 * Dummy model class for testing.
 */
class DummyModel
{
    // Empty dummy model
}
