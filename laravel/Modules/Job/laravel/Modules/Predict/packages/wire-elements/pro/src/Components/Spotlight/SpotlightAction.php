<?php

declare(strict_types=1);

namespace WireElements\Pro\Components\Spotlight;

use Illuminate\Support\Str;

abstract class SpotlightAction
{
    abstract public function description(): string;

    public function toArray()
    {
        $publicProperties = array_filter((new \ReflectionObject($this))->getProperties(), function ($property) {
            return $property->isPublic() && ! $property->isStatic();
        });

        $data = [];

        foreach ($publicProperties as $property) {
            if (self::class !== $property->getDeclaringClass()->getName()) {
                $data[$property->getName()] = $property->getValue($this);
            }
        }

        $data['description'] = $this->description();
        $data['type'] = Str::of(class_basename($this))->snake()->__toString();

        return $data;
    }
}
