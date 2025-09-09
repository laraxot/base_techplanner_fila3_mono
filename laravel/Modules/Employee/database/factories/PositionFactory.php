<?php

declare(strict_types=1);

namespace Modules\Employee\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Employee\Models\Position;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Employee\Models\Position>
 */
class PositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Modules\Employee\Models\Position>
     */
    protected $model = \Modules\Employee\Models\Position::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->jobTitle(),
            'description' => $this->faker->optional()->sentence(),
            'department' => $this->faker->randomElement(['HR', 'IT', 'Sales', 'Marketing', 'Finance', 'Operations']),
            'level' => $this->faker->numberBetween(1, 10),
            'is_active' => $this->faker->boolean(80), // 80% chance of being active
        ];
    }

    /**
     * Indicate that the position is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the position is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Set a specific position title.
     */
    public function withTitle(string $title): static
    {
        return $this->state(fn (array $attributes) => [
            'title' => $title,
        ]);
    }

    /**
     * Set a specific level.
     *
     * @param int $level
     * @return static
     */
    public function withLevel(int $level): static
    {
        return $this->state(fn (array $attributes) => [
            'level' => $level,
        ]);
    }

    /**
     * Set a specific description.
     */
    public function withDescription(string $description): static
    {
        return $this->state(fn (array $attributes) => [
            'description' => $description,
        ]);
    }
}
