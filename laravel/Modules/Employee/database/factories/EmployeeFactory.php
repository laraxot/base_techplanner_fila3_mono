<?php

declare(strict_types=1);

namespace Modules\Employee\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Employee\Models\Employee;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Employee\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
<<<<<<< HEAD
     * @var class-string<\Modules\Employee\Models\Employee>
     */
    //@phpstan-ignore-next-line
=======
     * @var string
     */
>>>>>>> cda86dd (.)
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
<<<<<<< HEAD
            'user_id' => null,
=======
            'user_id' => null, // Will be set when needed
>>>>>>> cda86dd (.)
            'employee_code' => 'EMP'.$this->faker->unique()->numberBetween(1000, 9999),
            'personal_data' => [
                'first_name' => $this->faker->firstName(),
                'last_name' => $this->faker->lastName(),
                'date_of_birth' => $this->faker->date(),
                'gender' => $this->faker->randomElement(['M', 'F', 'O']),
                'nationality' => $this->faker->countryCode(),
                'marital_status' => $this->faker->randomElement(['single', 'married', 'divorced', 'widowed']),
            ],
            'contact_data' => [
                'email' => $this->faker->unique()->safeEmail(),
                'phone' => $this->faker->phoneNumber(),
                'address' => [
                    'street' => $this->faker->streetAddress(),
                    'city' => $this->faker->city(),
<<<<<<< HEAD
                    'state' => $this->faker->randomElement(['IT', 'FR', 'DE', 'ES', 'UK']),
=======
<<<<<<< HEAD
                    'state' => $this->faker->state(),
=======
                    'state' => $this->faker->optional()->randomElement(['CA', 'NY', 'TX', 'FL', 'WA', 'IL', 'PA', 'OH']),
>>>>>>> 8e910bc (.)
>>>>>>> cda86dd (.)
                    'postal_code' => $this->faker->postcode(),
                    'country' => $this->faker->country(),
                ],
            ],
            'work_data' => [
                'employee_id' => $this->faker->unique()->numberBetween(10000, 99999),
                'hire_date' => $this->faker->date(),
                'contract_type' => $this->faker->randomElement(['full-time', 'part-time', 'contract', 'internship']),
                'work_schedule' => $this->faker->randomElement(['9-18', '8-17', 'flexible', 'shift']),
            ],
            'documents' => [
                'id_card' => $this->faker->optional()->uuid(),
                'passport' => $this->faker->optional()->uuid(),
                'work_permit' => $this->faker->optional()->uuid(),
            ],
            'photo_url' => $this->faker->optional()->imageUrl(),
            'status' => $this->faker->randomElement(['attivo', 'inattivo', 'sospeso', 'licenziato']),
<<<<<<< HEAD
            'department_id' => null,
            'manager_id' => null,
            'position_id' => null,
=======
            'department_id' => null, // Will be set when needed
            'manager_id' => null, // Will be set when needed
            'position_id' => null, // Will be set when needed
>>>>>>> cda86dd (.)
            'salary_data' => [
                'base_salary' => $this->faker->numberBetween(20000, 100000),
                'currency' => 'EUR',
                'payment_frequency' => $this->faker->randomElement(['monthly', 'bi-weekly', 'weekly']),
<<<<<<< HEAD
                'benefits' => $this->faker->optional()->words(3, false),
=======
                'benefits' => $this->faker->optional()->words(3),
>>>>>>> cda86dd (.)
            ],
        ];
    }

    /**
     * Indicate that the employee is active.
<<<<<<< HEAD
     *
     * @return static
=======
>>>>>>> cda86dd (.)
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'attivo',
        ]);
    }

    /**
     * Indicate that the employee is inactive.
<<<<<<< HEAD
     *
     * @return static
=======
>>>>>>> cda86dd (.)
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'inattivo',
        ]);
    }

    /**
     * Set a specific employee code.
     */
    public function withCode(string $code): static
    {
        return $this->state(fn (array $attributes) => [
            'employee_code' => $code,
        ]);
    }

    /**
     * Set specific personal data.
<<<<<<< HEAD
     *
     * @param array<string, mixed> $personalData
=======
>>>>>>> cda86dd (.)
     */
    public function withPersonalData(array $personalData): static
    {
        return $this->state(fn (array $attributes) => [
<<<<<<< HEAD
            'personal_data' => array_merge(
                is_array($attributes['personal_data'] ?? null) ? $attributes['personal_data'] : [],
                $personalData
            ),
=======
            'personal_data' => array_merge($attributes['personal_data'], $personalData),
>>>>>>> cda86dd (.)
        ]);
    }

    /**
     * Set specific contact data.
<<<<<<< HEAD
     *
     * @param array<string, mixed> $contactData
=======
>>>>>>> cda86dd (.)
     */
    public function withContactData(array $contactData): static
    {
        return $this->state(fn (array $attributes) => [
<<<<<<< HEAD
            'contact_data' => array_merge(
                is_array($attributes['contact_data'] ?? null) ? $attributes['contact_data'] : [],
                $contactData
            ),
=======
            'contact_data' => array_merge($attributes['contact_data'], $contactData),
>>>>>>> cda86dd (.)
        ]);
    }

    /**
     * Set a specific status.
     */
    public function withStatus(string $status): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => $status,
        ]);
    }
}
