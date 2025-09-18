<?php

declare(strict_types=1);

namespace Modules\Predict\Filament\Resources\PredictResource\Pages;

use Modules\Blog\Filament\Resources\ArticleResource\Pages\ListArticles as BaseListPredicts;
use Modules\Predict\Filament\Resources\PredictResource;

class ListPredicts extends BaseListPredicts
{
    protected static string $resource = PredictResource::class;
}
