<?php

declare(strict_types=1);

namespace Modules\Blog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Blog\Models\Comment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Blog\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Comment>
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment' => fake()->text,
            'post_id' => fake()->randomNumber(5),
            'user_id' => fake()->randomNumber(5),
            'parent_id' => fake()->randomNumber(5),
        ];
    }
}
