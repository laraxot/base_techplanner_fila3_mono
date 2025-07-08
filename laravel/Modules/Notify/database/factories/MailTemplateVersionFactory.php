<?php

namespace Modules\Notify\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MailTemplateVersionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Notify\Models\MailTemplateVersion::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

