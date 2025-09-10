<?php

/**
 * --.
 */
declare(strict_types=1);

namespace Modules\User\Filament\Resources\TenantResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Filament\Resources\TenantResource;

<<<<<<< HEAD
class CreateTenant extends CreateRecord
=======
class CreateTenant extends \Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord
>>>>>>> 96f269357d1a785a36860a85f377f9e5c58e50b8
{
    protected static string $resource = TenantResource::class;

    /**
     * @throws \Throwable
     */
    protected function handleRecordCreation(array $data): Model
    {
        return parent::handleRecordCreation(collect($data)->except('domain')->toArray());
    }

    // :30    Method Modules\User\Filament\Resources\TenantResource\Pages\CreateTenant::createTenantRecord() is unused.
    //      ✏️  User\Filament\Resources\TenantResource\Pages\CreateTenant.php
    // /**
    //  * @throws \Throwable
    //  */
    // private function createTenantRecord(array $data)
    // {
    //     \Log::info('Saving Tenant');
    //     $record = new Tenant(collect($data)->except('domain')->toArray());
    //     $record->saveOrFail();
    //     \Log::info('Saving Domains');
    //     $record = $record::find($record->id);
    //     $record->domains()->create(['domain' => collect($data)->get('domain')]);

    //     return $record;
    // }
}
