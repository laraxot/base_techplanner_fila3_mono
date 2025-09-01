<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\ModelClass;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Facades\Schema;
use Webmozart\Assert\Assert;

class TableExistsByModelClassActions
{
    public function execute(string $modelClass): bool
    {
        if (! class_exists($modelClass)) {
            return false;
        }

        Assert::isInstanceOf($model = app($modelClass), EloquentModel::class);


        $tableName = $model->getTable();

        return Schema::connection($model->getConnectionName())->hasTable($tableName);
    }
}
