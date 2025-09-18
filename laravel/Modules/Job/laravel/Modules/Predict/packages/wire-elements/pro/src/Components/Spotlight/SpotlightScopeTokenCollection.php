<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Spotlight;

use Illuminate\Support\Collection;
use Livewire\Wireable;

class SpotlightScopeTokenCollection extends Collection implements Wireable
{
    public function toQueryResults($query)
    {
        return collect($this->items)
            ->map(fn (SpotlightScopeToken $token) => $token->executeQueries($query, $this))
            ->flatten();
    }

    public function lastScopeToQueryResults($query)
    {
        return collect(collect($this->items)
            ->last()
            ?->executeQueries($query, $this))->flatten();
    }

    public function toLivewire()
    {
        return collect($this->items)->map(fn (SpotlightScopeToken $token) => $token->toLivewire());
    }

    public function push(...$values)
    {
        if (null === $this->first(fn (SpotlightScopeToken $token) => $token->type === $values[0]->type)) {
            parent::push(...$values);
        }

        return $this;
    }

    public static function fromLivewire($tokens)
    {
        $tokens = collect($tokens)
            ->map(function ($token) {
                return collect(Spotlight::$tokens)
                    ->firstWhere('type', '=', $token['type'])
                    ->fill(...$token);
            })->toArray();

        return new static($tokens);
    }
}
