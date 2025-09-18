<?php

declare(strict_types=1);

namespace Modules\Predict\Filament\Resources\PredictResource\Pages;

use Modules\Blog\Filament\Resources\ArticleResource\Pages\CreateArticle as BaseCreatePredict;
use Modules\Predict\Filament\Resources\PredictResource;

class CreatePredict extends BaseCreatePredict
{
    protected static string $resource = PredictResource::class;
}
