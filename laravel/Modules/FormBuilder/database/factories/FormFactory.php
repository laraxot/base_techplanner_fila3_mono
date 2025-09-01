<?php

declare(strict_types=1);

namespace Modules\FormBuilder\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\FormBuilder\Models\Category;
use Modules\FormBuilder\Models\Form;
use Modules\User\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\FormBuilder\Models\Form>
 */
class FormFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Modules\FormBuilder\Models\Form>
     */
    protected $model = Form::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->sentence(3);
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'is_active' => $this->faker->boolean(80), // 80% di probabilità di essere attivo
            'options' => [
                'show_title' => $this->faker->boolean(),
                'show_description' => $this->faker->boolean(),
                'require_login' => $this->faker->boolean(30),
                'allow_multiple_submissions' => $this->faker->boolean(20),
                'notification_email' => $this->faker->optional()->email(),
            ],
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'ordering' => $this->faker->numberBetween(1, 100),
            'details' => [
                'theme' => $this->faker->randomElement(['default', 'modern', 'classic']),
                'layout' => $this->faker->randomElement(['single', 'multi-step']),
                'submit_button_text' => $this->faker->randomElement(['Invia', 'Submit', 'Conferma']),
            ],
            'start_date' => $this->faker->optional()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => $this->faker->optional()->dateTimeBetween('+1 month', '+6 months'),
            'created_by' => $this->faker->optional()->uuid(),
            'updated_by' => $this->faker->optional()->uuid(),
        ];
    }

    /**
     * Indica che il form è attivo.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indica che il form è inattivo.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Indica che il form richiede login.
     */
    public function requiresLogin(): static
    {
        return $this->state(fn (array $attributes) => [
            'options' => array_merge($attributes['options'] ?? [], [
                'require_login' => true,
            ]),
        ]);
    }

    /**
     * Indica che il form permette multiple submission.
     */
    public function allowsMultipleSubmissions(): static
    {
        return $this->state(fn (array $attributes) => [
            'options' => array_merge($attributes['options'] ?? [], [
                'allow_multiple_submissions' => true,
            ]),
        ]);
    }

    /**
     * Indica che il form ha una data di inizio e fine.
     */
    public function withDateRange(): static
    {
        return $this->state(fn (array $attributes) => [
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
        ]);
    }
}
