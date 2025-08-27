<?php

declare(strict_types=1);

namespace Modules\Job\Filament\Resources\JobResource\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBasePage;
use Modules\Job\Filament\Resources\JobResource;

class BoardJobs extends XotBasePage
{
    protected static string $resource = JobResource::class;
}
