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
     * @var string
     */
    protected $model = Position::class;

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
            'level' => $this->faker->randomElement(['entry', 'junior', 'senior', 'lead', 'manager', 'director', 'executive']),
            'status' => $this->faker->randomElement(['attivo', 'inattivo']),
        ];
    }

    /**
     * Indicate that the position is active.
     *
     * @return static
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'attivo',
        ]);
    }

    /**
     * Indicate that the position is inactive.
     *
     * @return static
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'inattivo',
        ]);
    }

    /**
     * Set a specific position title.
     *
     * @param string $title
     * @return static
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
     * @param string $level
     * @return static
     */
    public function withLevel(string $level): static
    {
        return $this->state(fn (array $attributes) => [
            'level' => $level,
        ]);
    }

    /**
     * Set a specific description.
     *
     * @param string $description
     * @return static
     */
    public function withDescription(string $description): static
    {
        return $this->state(fn (array $attributes) => [
            'description' => $description,
        ]);
    }
}
