<?php

declare(strict_types=1);

namespace Modules\Predict\Filament\Resources\PredictResource\Pages;

use Modules\Blog\Filament\Resources\ArticleResource\Pages\EditArticle as BaseEditPredict;
use Modules\Predict\Filament\Resources\PredictResource;

class EditPredict extends BaseEditPredict
{
    protected static string $resource = PredictResource::class;
}
