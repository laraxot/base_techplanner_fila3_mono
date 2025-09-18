<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Modal\Foundation;

use Livewire\Component;
use Livewire\Mechanisms\ComponentRegistry;
use WireElements\Pro\Concerns\ComponentTypeDetector;
use WireElements\Pro\Contracts\BehavesAsModal;
use WireElements\Pro\Contracts\BehavesAsSlideOver;

abstract class Base extends Component
{
    use ComponentTypeDetector;

    public ?string $activeComponent;

    public array $components = [];

    public function registerAndActivateComponent($component, $arguments = [], $elementAttributes = [], $elementBehavior = []): void
    {
        $componentClass = app(ComponentRegistry::class)->getClass($component);

        $this->guard($componentClass);

        $id = (method_exists(
            $componentClass,
            'elementId'
        )) ? $componentClass::elementId() : md5($component.serialize($arguments));

        $arguments = collect($this->config('property-resolvers', []))
            ->reduce(function ($props, $resolver) use ($componentClass, $arguments) {
                return (new $resolver($componentClass, $arguments))->handle();
            }, $arguments);

        $this->components[$id] = [
            'name' => $component,
            'arguments' => $arguments,
            'parameters' => $arguments,
            'element-behaviors' => $this->buildElementBehavior($componentClass, $elementBehavior),
            'element-attributes' => $this->buildElementAttributes($componentClass, $elementAttributes),
        ];

        $this->activeComponent = $id;

        $this->dispatch("{$this->determineComponentType()}.componentActivated", id: $id);
    }

    public function removeComponentFromState($id)
    {
        unset($this->components[$id]);
    }

    public function resetState(): void
    {
        $this->components = [];
        $this->activeComponent = null;
    }

    public function render()
    {
        return view($this->config('view'));
    }

    private function guard($componentClass): void
    {
        $requiredInterface = match ($this->determineComponentType()) {
            'modal' => BehavesAsModal::class,
            'slide-over' => BehavesAsSlideOver::class,
        };

        if (false === in_array($requiredInterface, \Safe\class_implements($componentClass), true)) {
            throw new \UnexpectedValueException("[{$componentClass}] does not support this action. Required interface [{$requiredInterface}] is missing.");
        }
    }

    private function buildElementBehavior($componentClass, $elementBehavior): array
    {
        return array_merge($this->config('default-behavior'), $componentClass::behavior(), $elementBehavior);
    }

    private function buildElementAttributes($componentClass, $elementAttributes): array
    {
        $attributes = array_merge($this->config('default-attributes'), $componentClass::attributes(), $elementAttributes);

        $attributes['size'] = $this->config('size-map')[$attributes['size']] ?? '';

        return $attributes;
    }
}
