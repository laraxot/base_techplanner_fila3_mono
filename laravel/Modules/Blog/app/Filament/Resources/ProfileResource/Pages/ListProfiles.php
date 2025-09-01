<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ProfileResource\Pages;

use Filament\Tables\Columns\TextColumn;
use Modules\Blog\Filament\Actions\Profile\ModifyCredits;
use Modules\Blog\Filament\Resources\ProfileResource;
use Modules\User\Filament\Resources\BaseProfileResource\Pages\ListProfiles as UserListProfiles;

class ListProfiles extends UserListProfiles
{
    protected static string $resource = ProfileResource::class;

    // protected function getHeaderActions(): array
    // {
    //    return [
    //        Actions\CreateAction::make(),
    //    ];
    // }

    /**
     * Get table columns.
     *
     * @return array<string, \Filament\Tables\Columns\Column>
     */
    public function getTableColumns(): array
    {
        $res = parent::getTableColumns();

        $res['credits'] = TextColumn::make('credits');

        return $res;
    }

    /**
     * Sovrascrive la visibilità per rispettare la signature della classe base.
     * @return array<string, mixed>
     */
    /**
     * @return array<string, mixed>
     */
    public function getTableActions(): array
    {
        $res = parent::getTableActions();

        // $res[] = ModifyCredits::make();

        return $res;
    }
}
