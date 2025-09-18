<?php

declare(strict_types=1);

namespace Modules\Predict\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Predict\Models\Profile::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}
