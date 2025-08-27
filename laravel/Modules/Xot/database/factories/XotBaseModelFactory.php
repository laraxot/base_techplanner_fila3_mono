<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Xot\Models\XotBaseModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Xot\Models\XotBaseModel>
 */
class XotBaseModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
<<<<<<< HEAD
     * @var string
=======
     * @var class-string<\Modules\Xot\Models\XotBaseModel>
>>>>>>> 68b3eda (.)
     */
    protected $model = XotBaseModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
