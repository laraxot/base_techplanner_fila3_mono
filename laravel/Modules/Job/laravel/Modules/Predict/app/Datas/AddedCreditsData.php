<?php

declare(strict_types=1);

namespace Modules\Predict\Datas;

use Spatie\LaravelData\Data;

class AddedCreditsData extends Data
{
    // public string $adminId;
    public string $profileId;

    public string $userId;

    public float $credit;
}
