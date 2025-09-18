<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Spotlight;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Conditionable;
use Livewire\Component;
use Livewire\ImplicitlyBoundMethod;
use WireElements\Pro\Concerns\ComponentTypeDetector;
use WireElements\Pro\Contracts\BehavesAsSpotlight;

class Spotlight extends Component implements BehavesAsSpotlight
{
    use ComponentTypeDetector;
    use Conditionable;

    public static array $tips = [];

    public static array $actions = [];

    public static array $tokens = [];

    public static array $scopes = [];

    public static array $groups = [];

    public static array $queries = [];

    public static array $modes = [];

    public bool $initialised = false;

    public bool $active = false;

    public mixed $query = '';

    public mixed $route = null;

    public SpotlightScopeTokenCollection $activeTokens;

    private Collection $results;

    public static $setupCallbacks;

    public static function setup(callable $callback, $id = 'defer')
    {
        self::$setupCallbacks[$id] = $callback;
    }

    public function __construct()
    {
        if (isset(self::$setupCallbacks['defer'], $_SERVER['LARAVEL_OCTANE']) && 1 === (int) $_SERVER['LARAVEL_OCTANE']) {
            $this->clearMemory();
        }

        if (false === empty(self::$setupCallbacks)) {
            foreach (self::$setupCallbacks as $callback) {
                call_user_func($callback);
            }
        }
    }

    public function mount(Request $request)
    {
        $this->route = $request->route()?->getName() ?: false;
        $this->results = new Collection();
        $this->activeTokens = new SpotlightScopeTokenCollection();

        $this->resolveActiveTokensFromRequest($request);
    }

    public function close($andClearScope = false, $andPopScope = false)
    {
        $this->active = false;

        if ($andClearScope) {
            $this->clearScope();
        }
        if ($andPopScope) {
            $this->popScope();
        }
    }

    public function updatedActive($value)
    {
        if (true === $value) {
            $this->initialised = true;
            $this->query();
        }
    }

    public function updatedQuery(): void
    {
        $this->query();
    }

    public function query(): void
    {
        $mode = collect(Spotlight::$modes)
            ->first(fn (SpotlightMode $mode) => Str::of($this->query)->startsWith($mode->character));

        $queryString = $mode ? Str::of($this->query)->after($mode->character)->__toString() : $this->query;
        $queryResults = collect();

        $queryResults = $queryResults->merge(
            collect(Spotlight::$queries)
                ->when($mode, fn (Collection $collection) => $collection->where(fn (
                    SpotlightQuery $query,
                ) => $query->mode() === $mode->id))
                ->filter(fn (SpotlightQuery $query) => is_null($query->token()))
                ->filter(fn (
                    SpotlightQuery $query,
                ) => ! blank($mode) || $query->route() === $this->route || ($query->default() && $this->activeTokens->isEmpty()))
                ->map(fn (SpotlightQuery $query) => $query->run($queryString, $this->activeTokens))
                ->flatten()
        );

        $queryResults = $queryResults->merge($this->activeTokens->lastScopeToQueryResults($this->query));

        $this->results = collect(self::$groups)
            ->sortBy(fn (SpotlightGroup $group) => $group->priority())
            ->map(function (SpotlightGroup $group) use ($queryResults) {
                return $group->setItems($queryResults
                    ->filter(fn (SpotlightResult $result) => $result->group->id() === $group->id())
                    ->sortBy(fn (SpotlightResult $result) => $result->priority())
                    ->values()
                );
            })->reject(fn (SpotlightGroup $group) => $group->items()->isEmpty())->values();
    }

    public function applyTokens($tokens): void
    {
        collect($tokens)->each(function ($t) {
            $token = collect(Spotlight::$tokens)->first(fn (SpotlightScopeToken $token) => $t['type'] === $token->type);
            $token->params = $t['params'];
            $token->text = $t['text'];

            $this->activeTokens->push($token);
        });

        $this->query();
    }

    public function runAction($action): void
    {
        if (! isset($action['type'])) {
            return;
        }

        if (! isset(self::$actions[$action['type']])) {
            throw new \InvalidArgumentException("Action [{$action['type']}] doesn't exist.");
        }

        $availableProperties = collect((new \ReflectionClass(self::$actions[$action['type']]))->getProperties())->pluck('name');
        $extractedProperties = collect($action)->only($availableProperties);

        $action = new self::$actions[$action['type']](...$extractedProperties);
        ImplicitlyBoundMethod::call(app(), [$action, 'execute'], ['spotlight' => $this]);
    }

    public function popScope(): void
    {
        $this->activeTokens->pop();
        $this->query();
    }

    public function clearScope(): void
    {
        $this->activeTokens = new SpotlightScopeTokenCollection();

        if ($this->active) {
            $this->query();
        }
    }

    protected function resolveActiveTokensFromRequest(Request $request): void
    {
        if (empty($this->activeTokens)) {
            return;
        }

        $this->activeTokens = collect(self::$scopes)
            // Get all scopes applicable for given route
            ->filter(fn (SpotlightScope $scope) => $scope->matchesRoute($this->route))
            // Apply scope tokens with initial browser request
            ->map(fn (SpotlightScope $scope) => $scope->resolveTokensFromRequest($request))
            ->collapse()
            ->unique()
            ->flatten(1)
            ->pipeInto(SpotlightScopeTokenCollection::class);
    }

    public static function registerAction(string $id, string $action): void
    {
        if (false === class_exists($action)) {
            throw new \InvalidArgumentException("The action [$action] does not exist.");
        }

        self::$actions[$id] = $action;
    }

    public static function registerGroup(string $id, string $title, int $priority = 10): void
    {
        self::$groups[] = SpotlightGroup::make($id, $title, $priority);
    }

    public static function registerScopes(): void
    {
        array_push(self::$scopes, ...func_get_args());
    }

    public static function registerTokens(): void
    {
        array_push(self::$tokens, ...func_get_args());
    }

    public static function registerModes(): void
    {
        array_push(self::$modes, ...func_get_args());
    }

    public static function registerQueries(): void
    {
        array_push(self::$queries, ...func_get_args());
    }

    public static function registerTips(): void
    {
        array_push(self::$tips, ...func_get_args());
    }

    public function render()
    {
        $tips = collect(Spotlight::$tips);

        return view($this->config('view'), [
            'tip' => $tips->isEmpty() ? null : $tips->random(),
            'helpers' => collect(Spotlight::$modes)
                ->filter(fn (SpotlightMode $mode) => 'help' === $mode->id)->isNotEmpty(),
        ]);
    }

    private function clearMemory(): void
    {
        // To counter memory leaks when using Octane we reset the static properties.
        self::$tips = [];
        self::$actions = [];
        self::$tokens = [];
        self::$scopes = [];
        self::$groups = [];
        self::$queries = [];
        self::$modes = [];
    }
}
