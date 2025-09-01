<?php

namespace Modules\Comment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentNotificationOptOutFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Comment\Models\CommentNotificationOptOut::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}
