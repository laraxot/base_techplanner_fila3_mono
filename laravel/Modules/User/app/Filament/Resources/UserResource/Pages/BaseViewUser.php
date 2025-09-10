<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\Pages;

<<<<<<< HEAD
use Modules\User\Filament\Resources\UserResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
use Filament\Infolists;

/**
 * Base class for viewing user resources.
 * 
=======
use Filament\Infolists;
use Modules\User\Filament\Resources\UserResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

/**
 * Base class for viewing user resources.
 *
>>>>>>> 9831a351 (.)
 * This class provides the base configuration for viewing user resources
 * across the application. It should be extended by specific user type
 * view classes rather than used directly.
 */
abstract class BaseViewUser extends XotBaseViewRecord
{
    protected static string $resource = UserResource::class;

    /**
     * Define the infolist schema for the view.
     *
     * @return array<string, mixed>
     */
    public function getInfolistSchema(): array
    {
        return [
            'name' => Infolists\Components\TextEntry::make('name')
                ->label(trans('user::resource.fields.name')),
<<<<<<< HEAD
                
            'email' => Infolists\Components\TextEntry::make('email')
                ->label(trans('user::resource.fields.email')),
                
            'type' => Infolists\Components\TextEntry::make('type')
                ->label(trans('user::resource.fields.type')),
                
            'state' => Infolists\Components\TextEntry::make('state')
                ->label(trans('user::resource.fields.state')),
                
            'created_at' => Infolists\Components\TextEntry::make('created_at')
                ->label(trans('user::resource.fields.created_at'))
                ->dateTime(),
                
=======

            'email' => Infolists\Components\TextEntry::make('email')
                ->label(trans('user::resource.fields.email')),

            'type' => Infolists\Components\TextEntry::make('type')
                ->label(trans('user::resource.fields.type')),

            'state' => Infolists\Components\TextEntry::make('state')
                ->label(trans('user::resource.fields.state')),

            'created_at' => Infolists\Components\TextEntry::make('created_at')
                ->label(trans('user::resource.fields.created_at'))
                ->dateTime(),

>>>>>>> 9831a351 (.)
            'updated_at' => Infolists\Components\TextEntry::make('updated_at')
                ->label(trans('user::resource.fields.updated_at'))
                ->dateTime(),
        ];
    }
}
