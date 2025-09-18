<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Spotlight;

use Illuminate\Support\Arr;
use Livewire\Wireable;

class SpotlightScopeToken implements Wireable
{
    public array $params = [];

    public ?string $text = null;

    public ?string $type;

    public ?\Closure $closure;

    public function __construct(string $type, ?\Closure $closure = null)
    {
        $this->type = $type;
        $this->closure = $closure;
    }

    public function executeQueries($searchQuery, $tokenCollection)
    {
        return collect(Spotlight::$queries)
            ->filter(fn (SpotlightQuery $query) => $query->token() === $this->type)
            ->map(fn (SpotlightQuery $query) => $query->run($searchQuery, $tokenCollection))
            ->values()
            ->toArray();
    }

    public function resolve($dependencies = []): self
    {
        if (is_null($this->closure)) {
            return $this;
        }

        app()->call($this->closure, array_merge(
            ['token' => $this],
            Arr::wrap($dependencies)
        ));

        $a = clone $this;
        $a->fill($this->params, $this->type, $this->text);

        return $a;
    }

    public function fill(array $params, $type, $text): self
    {
        $this->type = $type;
        $this->params = $params;
        $this->text = $text;

        return $this;
    }

    public static function make($type, ?\Closure $closure = null): self
    {
        return new static($type, $closure);
    }

    public function getParameter($key, $default = null)
    {
        return Arr::get($this->params, $key, $default);
    }

    public function setParameters(array $params): SpotlightScopeToken
    {
        $this->params = $params;

        return $this;
    }

    public function setText(string $text): SpotlightScopeToken
    {
        $this->text = $text;

        return $this;
    }

    public function toArray()
    {
        return [
            'params' => $this->params,
            'type' => $this->type,
            'text' => $this->text,
        ];
    }

    public function toLivewire()
    {
        return $this->toArray();
    }

    public static function fromLivewire($value)
    {
        $token = new static($value['type']);
        $token->params = $value['params'];
        $token->type = $value['type'];
        $token->text = $value['text'];

        return $token;
    }
}
