<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Model\Update;

use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Actions\Model\FilterRelationsAction;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class RelationAction
{
    use QueueableAction;

    /**
     * Execute relation updates with type-safe data.
     *
     * @param  array<mixed, mixed>  $data
     */
    public function execute(Model $model, array $data): void
    {
        // Assicura che $data sia type-safe per FilterRelationsAction
        /** @var array<string, mixed> $typedData */
        $typedData = [];
        foreach ($data as $key => $value) {
            $typedData[(string) $key] = $value;
        }

        $relations = app(FilterRelationsAction::class)->execute($model, $typedData);
        /*
        if ('Operation' === class_basename($model)) {
            dddx([
                'basename' => class_basename($model),
                'model' => $model,
                'data' => $data,
                'relations' => $relations,
            ]);
        }
        // */
        foreach ($relations as $relation) {
            // Ottieni il tipo di relazione dal nome della classe
            $relationClass = get_class($relation);
            $relationshipType = class_basename($relationClass);

            $actionClass = __NAMESPACE__.'\\'.$relationshipType.'Action';
            Assert::object($action = app($actionClass));

            if (method_exists($action, 'execute')) {
                $action->execute($model, $relation);
            }
        }
    }
}
