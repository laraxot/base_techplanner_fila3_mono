<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\TenantResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Modules\Xot\Filament\Resources\XotBaseResource\RelationManager\XotBaseRelationManager;
use Modules\Xot\Filament\Traits\HasXotTable;

class UsersRelationManager extends XotBaseRelationManager
{
    use HasXotTable;

    protected static string $relationship = 'users';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form->schema($this->getFormSchema());
    }

    /**
     * @return array<Forms\Components\Component>
     */
    public function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')

                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')

                ->email()
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

            Forms\Components\DateTimePicker::make('email_verified_at')

                ->nullable(),

            Forms\Components\TextInput::make('password')

                ->password()
                ->required(fn ($context) => $context === 'create')
                ->minLength(8)
                ->same('password_confirmation')
                ->dehydrated(fn ($state) => filled($state))
                ->dehydrateStateUsing(fn ($state) => bcrypt($state)),

            Forms\Components\TextInput::make('password_confirmation')

                ->password()
                ->required(fn ($context) => $context === 'create')
                ->minLength(8),
        ];
    }

    public function getListTableColumns(): array
    {
        return [
            TextColumn::make('id')

                ->sortable()
                ->toggleable(),

            TextColumn::make('name')

                ->searchable()
                ->sortable()
                ->toggleable(),

            TextColumn::make('email')

                ->searchable()
                ->sortable()
                ->toggleable(),

            TextColumn::make('email_verified_at')

                ->dateTime()
                ->sortable()
                ->toggleable(),

            TextColumn::make('created_at')

                ->dateTime()
                ->sortable()
                ->toggleable(),

            TextColumn::make('updated_at')

                ->dateTime()
                ->sortable()
                ->toggleable(),
        ];
    }
}
