<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Spotlight;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpotlightScope
{
    protected string $route;

    protected \Closure $closure;

    protected array $tokenDependencies = [];

    public function __construct(string $route, \Closure $closure)
    {
        $this->route = $route;
        $this->closure = $closure;
    }

    public static function forRoute(string $route, \Closure $closure): self
    {
        return new static($route, $closure);
    }

    public function applyToken($tokenName, $tokenDependencies = [])
    {
        if (false === is_array($tokenDependencies)) {
            $tokenDependencies = [$tokenName => $tokenDependencies];
        }

        $this->tokenDependencies[$tokenName] = $tokenDependencies;
    }

    public function resolveTokensFromRequest(Request $request): ?array
    {
        app()->call($this->closure, ['scope' => $this, 'request' => $request]);

        /* @var SpotlightScopeToken $token */
        return collect(Spotlight::$tokens)
            ->filter(fn (SpotlightScopeToken $token) => array_key_exists($token->type, $this->tokenDependencies))
            ->values()
            ->each(function (SpotlightScopeToken $token) {
                $token->resolve($this->tokenDependencies[$token->type] ?? null);
            })->toArray();
    }

    public function matchesRoute($route): bool
    {
        return '*' === $this->route || Str::of($route)->is($this->route);
    }
}
