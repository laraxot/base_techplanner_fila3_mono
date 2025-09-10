<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\DeviceResource\RelationManagers;

use Filament\Forms\Components\TextInput;
<<<<<<< HEAD
use Filament\Forms\Form;
=======
>>>>>>> 9831a351 (.)
use Filament\Tables\Table;
use Modules\User\Filament\Resources\UserResource;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;

<<<<<<< HEAD








=======
>>>>>>> 9831a351 (.)
class UsersRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'users';

    /**
     * @return array<string, \Filament\Forms\Components\Component>
     */
    public function getFormSchema(): array
    {
        return [
            'device' => TextInput::make('device')
                ->required()
                ->maxLength(255),
        ];
    }

    public function table(Table $table): Table
    {
        $table = UserResource::table($table);

        return $table;
    }
}
