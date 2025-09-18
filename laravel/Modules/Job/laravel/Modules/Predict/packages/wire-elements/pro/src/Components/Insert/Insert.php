<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Insert;

use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\ImplicitlyBoundMethod;
use WireElements\Pro\Components\Insert\Types\InsertType;
use WireElements\Pro\Concerns\ComponentTypeDetector;
use WireElements\Pro\Contracts\BehavesAsInsert;

class Insert extends Component implements BehavesAsInsert
{
    use ComponentTypeDetector;

    public $matchedTypes;

    public $query;

    public $scope = [];

    public Collection $types;

    public function mount()
    {
        $this->types = collect($this->config('types'))->map(function ($type) {
            $type = new $type();

            return $type->toArray();
        });
    }

    public function select($insertInstanceId, $id)
    {
        $item = $this->results->firstWhere('id', $id);

        if ($insertValue = $item['insert'] ?? null) {
            $this->dispatch('remoteInsert', instance: $insertInstanceId, value: $insertValue);
        }

        if ($events = $item['emit'] ?? $item['dispatch'] ?? []) {
            foreach ($events as $event => $options) {
                $options['arguments'] = array_merge(['insertInstanceId' => $insertInstanceId], $options['arguments'] ?? []);

                $this->dispatch($event, ...$options);
            }
        }
    }

    public function setSearchParams($types, $query, $scope = []): void
    {
        if (blank($types)) {
            return;
        }

        $this->matchedTypes = $types;
        $this->query = $query;
        $this->scope = $scope;
    }

    public function getResultsProperty(): Collection
    {
        return collect($this->matchedTypes)->map(function ($type) {
            /** @var InsertType $mentionType */
            $mentionType = app($this->config('types')[$type]);

            return ImplicitlyBoundMethod::call(app(), [$mentionType, 'initSearch'], [
                'query' => $this->query,
                'scope' => $this->scope,
            ])?->getResults()->map(fn ($t) => $t->toArray());
        })->flatten(1);
    }

    public function render()
    {
        return view($this->config('view'), [
            'parameters' => [
                'types' => $this->types,
                'behavior' => $this->config('default-behavior'),
            ],
        ]);
    }
}
