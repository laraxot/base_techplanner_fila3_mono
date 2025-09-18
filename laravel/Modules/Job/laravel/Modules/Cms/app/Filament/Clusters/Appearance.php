<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Clusters;

use Filament\Clusters\Cluster;

class Appearance extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Settings';
}
