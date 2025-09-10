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
<<<<<<< HEAD
     * @var class-string<\Modules\Employee\Models\Position>
=======
     * @var string
>>>>>>> cda86dd (.)
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
<<<<<<< HEAD
            'department' => $this->faker->randomElement(['HR', 'IT', 'Sales', 'Marketing', 'Finance', 'Operations']),
            'level' => $this->faker->numberBetween(1, 10),
            'is_active' => $this->faker->boolean(80), // 80% chance of being active
=======
            'level' => $this->faker->randomElement(['entry', 'junior', 'senior', 'lead', 'manager', 'director', 'executive']),
            'status' => $this->faker->randomElement(['attivo', 'inattivo']),
>>>>>>> cda86dd (.)
        ];
    }

    /**
     * Indicate that the position is active.
<<<<<<< HEAD
     *
     * @return static
=======
>>>>>>> cda86dd (.)
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
<<<<<<< HEAD
            'is_active' => true,
=======
            'status' => 'attivo',
>>>>>>> cda86dd (.)
        ]);
    }

    /**
     * Indicate that the position is inactive.
<<<<<<< HEAD
     *
     * @return static
=======
>>>>>>> cda86dd (.)
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
<<<<<<< HEAD
            'is_active' => false,
=======
            'status' => 'inattivo',
>>>>>>> cda86dd (.)
        ]);
    }

    /**
     * Set a specific position title.
<<<<<<< HEAD
     *
     * @param string $title
     * @return static
=======
>>>>>>> cda86dd (.)
     */
    public function withTitle(string $title): static
    {
        return $this->state(fn (array $attributes) => [
            'title' => $title,
        ]);
    }

    /**
     * Set a specific level.
<<<<<<< HEAD
     *
     * @param int $level
     * @return static
     */
    public function withLevel(int $level): static
=======
     */
    public function withLevel(string $level): static
>>>>>>> cda86dd (.)
    {
        return $this->state(fn (array $attributes) => [
            'level' => $level,
        ]);
    }

    /**
     * Set a specific description.
<<<<<<< HEAD
     *
     * @param string $description
     * @return static
=======
>>>>>>> cda86dd (.)
     */
    public function withDescription(string $description): static
    {
        return $this->state(fn (array $attributes) => [
            'description' => $description,
        ]);
    }
}
