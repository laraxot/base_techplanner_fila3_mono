<?php

declare(strict_types=1);

namespace Modules\Employee\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Employee\Models\Department;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Employee\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
<<<<<<< HEAD
     * @var class-string<\Modules\Employee\Models\Department>
     */
    protected $model = \Modules\Employee\Models\Department::class;
=======
     * @var string
     */
    protected $model = Department::class;
>>>>>>> cda86dd (.)

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
<<<<<<< HEAD
            'name' => $this->faker->unique()->word().' Department',
            'description' => $this->faker->optional()->sentence(),
            'is_active' => $this->faker->boolean(80), // 80% chance of being active
=======
<<<<<<< HEAD
            'name' => $this->faker->unique()->department(),
=======
            'name' => $this->faker->unique()->randomElement(['HR', 'IT', 'Sales', 'Marketing', 'Finance', 'Operations']),
>>>>>>> 8e910bc (.)
            'description' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['attivo', 'inattivo']),
>>>>>>> cda86dd (.)
            'manager_id' => null, // Will be set when needed
        ];
    }

    /**
     * Indicate that the department is active.
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
     * Indicate that the department is inactive.
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
     * Set a specific department name.
<<<<<<< HEAD
     *
     * @param string $name
     * @return static
=======
>>>>>>> cda86dd (.)
     */
    public function withName(string $name): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $name,
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
