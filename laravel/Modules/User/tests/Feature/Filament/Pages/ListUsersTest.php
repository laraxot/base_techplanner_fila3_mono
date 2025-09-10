<?php

declare(strict_types=1);

<<<<<<< HEAD
use Modules\User\Filament\Resources\UserResource\Pages\ListUsers;
use Modules\User\Filament\Resources\UserResource;
use Modules\User\Filament\Actions\ChangePasswordAction;
use Modules\User\Filament\Resources\UserResource\Widgets\UserOverview;
use Modules\User\Models\User;
use Modules\User\Enums\UserType;
use Illuminate\Support\Facades\Hash;
=======
use Modules\User\Enums\UserType;
use Modules\User\Filament\Actions\ChangePasswordAction;
use Modules\User\Filament\Resources\UserResource;
use Modules\User\Filament\Resources\UserResource\Pages\ListUsers;
use Modules\User\Filament\Resources\UserResource\Widgets\UserOverview;
use Modules\User\Models\User;
>>>>>>> 9831a351 (.)

uses(Tests\TestCase::class);

beforeEach(function (): void {
<<<<<<< HEAD
    $this->listUsersPage = new ListUsers();
    
=======
    $this->listUsersPage = new ListUsers;

>>>>>>> 9831a351 (.)
    // Create some test users
    $this->users = User::factory()->count(3)->create([
        'type' => UserType::MasterAdmin,
    ]);
});

test('list users page has correct resource', function (): void {
    expect(ListUsers::getResource())->toBe(UserResource::class);
});

test('list users page extends correct base class', function (): void {
    expect($this->listUsersPage)->toBeInstanceOf(\Modules\User\Filament\Resources\UserResource\Pages\BaseListUsers::class);
});

test('list users page can be instantiated', function (): void {
    expect($this->listUsersPage)->toBeInstanceOf(ListUsers::class);
});

test('list users page has correct table columns', function (): void {
    $columns = $this->listUsersPage->getTableColumns();
<<<<<<< HEAD
    
    expect($columns)->toHaveKey('name');
    expect($columns)->toHaveKey('email');
    
=======

    expect($columns)->toHaveKey('name');
    expect($columns)->toHaveKey('email');

>>>>>>> 9831a351 (.)
    // Test name column
    $nameColumn = $columns['name'];
    expect($nameColumn)->toBeInstanceOf(\Filament\Tables\Columns\TextColumn::class);
    expect($nameColumn->getName())->toBe('name');
    expect($nameColumn->isSearchable())->toBeTrue();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    // Test email column
    $emailColumn = $columns['email'];
    expect($emailColumn)->toBeInstanceOf(\Filament\Tables\Columns\TextColumn::class);
    expect($emailColumn->getName())->toBe('email');
    expect($emailColumn->isSearchable())->toBeTrue();
});

test('list users page has correct table filters', function (): void {
    $filters = $this->listUsersPage->getTableFilters();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    // Currently no filters are defined
    expect($filters)->toBeArray();
    expect($filters)->toHaveCount(0);
});

test('list users page has correct table actions', function (): void {
    $actions = $this->listUsersPage->getTableActions();
<<<<<<< HEAD
    
    expect($actions)->toHaveKey('change_password');
    expect($actions)->toHaveKey('deactivate');
    
    // Test change password action
    $changePasswordAction = $actions['change_password'];
    expect($changePasswordAction)->toBeInstanceOf(ChangePasswordAction::class);
    
=======

    expect($actions)->toHaveKey('change_password');
    expect($actions)->toHaveKey('deactivate');

    // Test change password action
    $changePasswordAction = $actions['change_password'];
    expect($changePasswordAction)->toBeInstanceOf(ChangePasswordAction::class);

>>>>>>> 9831a351 (.)
    // Test deactivate action
    $deactivateAction = $actions['deactivate'];
    expect($deactivateAction)->toBeInstanceOf(\Filament\Tables\Actions\Action::class);
    expect($deactivateAction->getColor())->toBe('danger');
    expect($deactivateAction->getIcon())->toBe('heroicon-o-trash');
});

test('list users page has correct header widgets', function (): void {
    $widgets = $this->listUsersPage->getHeaderWidgets();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    expect($widgets)->toHaveCount(1);
    expect($widgets)->toContain(UserOverview::class);
});

test('list users page has correct bulk actions', function (): void {
    $bulkActions = $this->listUsersPage->getTableBulkActions();
<<<<<<< HEAD
    
    expect($bulkActions)->toHaveKey('delete');
    expect($bulkActions)->toHaveKey('export');
    
    // Test delete bulk action
    $deleteAction = $bulkActions['delete'];
    expect($deleteAction)->toBeInstanceOf(\Filament\Tables\Actions\DeleteBulkAction::class);
    
=======

    expect($bulkActions)->toHaveKey('delete');
    expect($bulkActions)->toHaveKey('export');

    // Test delete bulk action
    $deleteAction = $bulkActions['delete'];
    expect($deleteAction)->toBeInstanceOf(\Filament\Tables\Actions\DeleteBulkAction::class);

>>>>>>> 9831a351 (.)
    // Test export bulk action
    $exportAction = $bulkActions['export'];
    expect($exportAction)->toBeInstanceOf(\Filament\Tables\Actions\ExportBulkAction::class);
});

test('list users page can display users', function (): void {
    // This test would require proper Livewire setup
    // For now, we'll test the basic structure
<<<<<<< HEAD
    
    $users = User::all();
    expect($users)->toHaveCount(3);
    
=======

    $users = User::all();
    expect($users)->toHaveCount(3);

>>>>>>> 9831a351 (.)
    foreach ($users as $user) {
        expect($user)->toBeInstanceOf(User::class);
        expect($user->type)->toBe(UserType::MasterAdmin);
    }
});

test('list users page has correct navigation label', function (): void {
    $label = ListUsers::getNavigationLabel();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    // The label should be defined or fall back to default
    expect($label)->not->toBeNull();
});

test('list users page has correct title', function (): void {
    $title = ListUsers::getTitle();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    // The title should be defined or fall back to default
    expect($title)->not->toBeNull();
});

test('list users page has correct breadcrumbs', function (): void {
    $breadcrumbs = ListUsers::getBreadcrumbs();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    // Breadcrumbs should be an array
    expect($breadcrumbs)->toBeArray();
});

test('list users page can handle search', function (): void {
    // Test that searchable columns are properly configured
    $columns = $this->listUsersPage->getTableColumns();
<<<<<<< HEAD
    
    $nameColumn = $columns['name'];
    $emailColumn = $columns['email'];
    
=======

    $nameColumn = $columns['name'];
    $emailColumn = $columns['email'];

>>>>>>> 9831a351 (.)
    expect($nameColumn->isSearchable())->toBeTrue();
    expect($emailColumn->isSearchable())->toBeTrue();
});

test('list users page can handle sorting', function (): void {
    // Test that columns can be sorted
    $columns = $this->listUsersPage->getTableColumns();
<<<<<<< HEAD
    
    $nameColumn = $columns['name'];
    $emailColumn = $columns['email'];
    
=======

    $nameColumn = $columns['name'];
    $emailColumn = $columns['email'];

>>>>>>> 9831a351 (.)
    // By default, columns should be sortable
    expect($nameColumn->isSortable())->toBeTrue();
    expect($emailColumn->isSortable())->toBeTrue();
});

test('list users page can handle pagination', function (): void {
    // Test that pagination is properly configured
    $pagination = ListUsers::getTablePaginationPageOptions();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    // Should have pagination options
    expect($pagination)->toBeArray();
});

test('list users page has correct table query', function (): void {
    // Test that the table query is properly configured
    $query = ListUsers::getTableQuery();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    // Should return a query builder
    expect($query)->toBeInstanceOf(\Illuminate\Database\Eloquent\Builder::class);
});

test('list users page can handle record selection', function (): void {
    // Test that record selection is properly configured
    $canSelectRecords = ListUsers::canSelectRecords();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    // Should allow record selection for bulk actions
    expect($canSelectRecords)->toBeTrue();
});

test('list users page has correct table layout', function (): void {
    // Test that the table layout is properly configured
    $layout = ListUsers::getTableLayout();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    // Should have a layout defined
    expect($layout)->not->toBeNull();
});

test('list users page can handle empty state', function (): void {
    // Test that empty state is properly configured
    $emptyStateHeading = ListUsers::getTableEmptyStateHeading();
    $emptyStateDescription = ListUsers::getTableEmptyStateDescription();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    // Should have empty state messages
    expect($emptyStateHeading)->not->toBeNull();
    expect($emptyStateDescription)->not->toBeNull();
});

test('list users page has correct table actions alignment', function (): void {
    // Test that table actions are properly aligned
    $actionsAlignment = ListUsers::getTableActionsAlignment();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    // Should have actions alignment defined
    expect($actionsAlignment)->not->toBeNull();
});

test('list users page can handle table records per page', function (): void {
    // Test that records per page is properly configured
    $recordsPerPage = ListUsers::getTableRecordsPerPageSelectOptions();
<<<<<<< HEAD
    
=======

>>>>>>> 9831a351 (.)
    // Should have records per page options
    expect($recordsPerPage)->toBeArray();
});
