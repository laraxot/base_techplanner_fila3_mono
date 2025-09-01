<?php

declare(strict_types=1);

namespace Modules\Blog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Models\UpvoteDownvote;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Blog\Models\UpvoteDownvote>
 */
class UpvoteDownvoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<UpvoteDownvote>
     */
    protected $model = UpvoteDownvote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'is_upvote' => fake()->boolean,
            'post_id' => fake()->randomNumber(5),
            'user_id' => fake()->randomNumber(5),
        ];
    }
}
