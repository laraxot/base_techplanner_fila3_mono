<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Spotlight;

use Illuminate\Support\Collection;
use Livewire\ImplicitlyBoundMethod;

class SpotlightQuery
{
    private ?bool $default = null;

    private ?string $token = null;

    private ?string $mode = null;

    private ?string $route = null;

    private \Closure $callable;

    public function __construct(\Closure $callable)
    {
        $this->callable = $callable;
    }

    public function route(): ?string
    {
        return $this->route;
    }

    public function token(): ?string
    {
        return $this->token;
    }

    public function mode(): ?string
    {
        return $this->mode;
    }

    public function default(): ?bool
    {
        return $this->default;
    }

    public function run(mixed $query = null, ?SpotlightScopeTokenCollection $tokens = null): Collection
    {
        return ImplicitlyBoundMethod::call(app(), $this->callable, array_merge(
            ['query' => $query],
            $tokens->mapWithKeys(fn (SpotlightScopeToken $token) => [$token->type.'Token' => $token])->toArray()
        ))->when($this->mode, function (Collection $collection) {
            $collection->filter(fn (SpotlightResult $result) => $result->group->isDefault())
                ->each(fn (SpotlightResult $result) => $result->setGroup($this->mode));
        });
    }

    public static function forToken(string $token, \Closure $callable): self
    {
        $query = new self($callable);
        $query->token = $token;

        return $query;
    }

    public static function forRoute(string $route, \Closure $callable): self
    {
        $query = new self($callable);
        $query->route = $route;

        return $query;
    }

    public static function forMode(string $mode, \Closure $callable): self
    {
        $query = new self($callable);
        $query->mode = $mode;

        return $query;
    }

    public static function asDefault(\Closure $callable): self
    {
        $query = new self($callable);
        $query->default = true;

        return $query;
    }
}
