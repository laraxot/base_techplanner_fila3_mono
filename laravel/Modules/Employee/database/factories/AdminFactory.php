<?php

namespace Modules\Employee\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Employee\Models\Admin::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

