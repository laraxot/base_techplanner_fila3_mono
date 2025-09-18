<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Spotlight;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use WireElements\Pro\Icons\Icon;
use WireElements\Pro\WireElementsPro;

class SpotlightResult
{
    public string $title;

    public ?string $subtitle = null;

    public ?string $typeahead = null;

    public ?string $image = null;

    private string $view = 'wire-elements-pro::spotlight.item';

    public array $meta = [];

    public int $priority = 1;

    public Collection $tokens;

    public SpotlightGroup $group;

    public ?Icon $icon = null;

    public SpotlightAction $action;

    public function __construct()
    {
        $this->tokens = collect();
        $this->setGroup('results');
    }

    public function title(): string
    {
        return $this->title;
    }

    public function subtitle(): ?string
    {
        return $this->subtitle;
    }

    public function typeahead(): ?string
    {
        return $this->typeahead ?: $this->title();
    }

    public function image(): ?string
    {
        return $this->image;
    }

    public function icon(): ?Icon
    {
        return $this->icon;
    }

    public function action(): ?SpotlightAction
    {
        return $this->action;
    }

    public function tokens(): Collection
    {
        return $this->tokens;
    }

    public function view(): ?string
    {
        return $this->view;
    }

    public function meta(): ?array
    {
        return $this->meta;
    }

    public function priority(): ?int
    {
        return $this->priority;
    }

    public function setTitle(string $title): SpotlightResult
    {
        $this->title = $title;

        return $this;
    }

    public function setSubtitle(string $subtitle): SpotlightResult
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function setTypeahead(string $typeahead): SpotlightResult
    {
        $this->typeahead = $typeahead;

        return $this;
    }

    public function setPriority(int $priority): SpotlightResult
    {
        $this->priority = $priority;

        return $this;
    }

    public function setView(string $view): SpotlightResult
    {
        $this->view = $view;

        return $this;
    }

    public function setMeta(array $meta): SpotlightResult
    {
        $this->meta = $meta;

        return $this;
    }

    public function setGroup($groupId): SpotlightResult
    {
        $group = collect(Spotlight::$groups)->first(fn ($group) => $group->id() === $groupId);

        if (is_null($group)) {
            throw new \InvalidArgumentException("Group [$groupId] does not exist.");
        }

        $this->group = $group;

        return $this;
    }

    public function setIcon($icon): SpotlightResult
    {
        $iconClass = config("wire-elements-pro.icons.{$icon}", false);

        if (false === $iconClass) {
            throw new \InvalidArgumentException("Icon [$icon] is not defined in the config.");
        }

        if (false === isset(WireElementsPro::$icons[$icon])) {
            WireElementsPro::$icons[$icon] = new $iconClass();
        }

        $this->icon = WireElementsPro::$icons[$icon];

        return $this;
    }

    public function setImage(string $src): SpotlightResult
    {
        $this->image = $src;

        return $this;
    }

    public function setAction($actionId, $params = []): SpotlightResult
    {
        if (! isset(Spotlight::$actions[$actionId])) {
            throw new \InvalidArgumentException("Action [{$actionId}] doesn't exist.");
        }

        $this->action = new Spotlight::$actions[$actionId](...$params);

        return $this;
    }

    public function setTokens($tokens): SpotlightResult
    {
        $this->tokens = collect($tokens)->map(function ($dependencies, $tokenId) {
            if (false === is_int($tokenId)) {
                $dependencies = [$tokenId => $dependencies];
            }
            if (is_string($dependencies)) {
                $tokenId = $dependencies;
                $dependencies = null;
            }

            $token = collect(Spotlight::$tokens)->first(fn (SpotlightScopeToken $token) => $token->type === $tokenId);

            if (is_null($token)) {
                throw new \InvalidArgumentException("Token [$tokenId] does not exist.");
            }

            return $token->resolve(Arr::wrap($dependencies));
        });

        return $this;
    }

    public static function make(): self
    {
        return new static();
    }

    public function fingerprint()
    {
        return md5($this->title.$this->subtitle.$this->image.$this->typeahead.$this->priority.\Safe\json_encode($this->group).\Safe\json_encode($this->icon).\Safe\json_encode($this->action).\Safe\json_encode($this->action));
    }

    public function toArray()
    {
        return [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'image' => $this->image,
            'typeahead' => $this->typeahead,
            'priority' => $this->priority,
            'meta' => $this->meta,
            'group' => $this->group->toArray(),
            'icon' => $this->icon?->toArray() ?? [],
            'action' => $this->action->toArray(),
            'tokens' => $this->tokens->map(fn ($c) => $c->toArray())->toArray(),
            'fingerprint' => $this->fingerprint(),
        ];
    }
}
