<?php

declare(strict_types=1);

namespace Modules\Blog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Blog\Models\Banner;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Blog\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Banner>
     */
    protected $model = Banner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence,
            // 'slug' => $this->faker->slug,
        ];
    }
}
