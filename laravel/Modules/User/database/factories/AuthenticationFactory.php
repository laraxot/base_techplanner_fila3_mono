<?php

declare(strict_types=1);

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Models\Authentication;
use Modules\User\Models\User;

/**
 * Authentication Factory
<<<<<<< HEAD
 *
 * Factory for creating Authentication model instances for testing and seeding.
 *
=======
 * 
 * Factory for creating Authentication model instances for testing and seeding.
 * 
>>>>>>> 8055579 (.)
 * @extends Factory<Authentication>
 */
class AuthenticationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 8055579 (.)
     * @var class-string<Authentication>
     */
    protected $model = Authentication::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $loginSuccessful = $this->faker->boolean(85); // 85% success rate
        $loginAt = $this->faker->dateTimeBetween('-1 year', 'now');
<<<<<<< HEAD

=======
        
>>>>>>> 8055579 (.)
        return [
            'type' => $this->faker->randomElement(['login', 'logout', 'password_reset', 'email_verification']),
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
<<<<<<< HEAD
            'location' => $this->faker->optional(0.7)->city().', '.$this->faker->optional(0.7)->country(),
            'login_successful' => $loginSuccessful,
            'login_at' => $loginAt,
            'logout_at' => $loginSuccessful && $this->faker->boolean(60)
                ? $this->faker->dateTimeBetween($loginAt, 'now')
=======
            'location' => $this->faker->optional(0.7)->city() . ', ' . $this->faker->optional(0.7)->country(),
            'login_successful' => $loginSuccessful,
            'login_at' => $loginAt,
            'logout_at' => $loginSuccessful && $this->faker->boolean(60) 
                ? $this->faker->dateTimeBetween($loginAt, 'now') 
>>>>>>> 8055579 (.)
                : null,
            'authenticatable_type' => User::class,
            'authenticatable_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the authentication was successful.
<<<<<<< HEAD
=======
     *
     * @return static
>>>>>>> 8055579 (.)
     */
    public function successful(): static
    {
        return $this->state(fn (array $attributes): array => [
            'login_successful' => true,
        ]);
    }

    /**
     * Indicate that the authentication failed.
<<<<<<< HEAD
=======
     *
     * @return static
>>>>>>> 8055579 (.)
     */
    public function failed(): static
    {
        return $this->state(fn (array $attributes): array => [
            'login_successful' => false,
            'logout_at' => null,
        ]);
    }

    /**
     * Set the authentication type to login.
<<<<<<< HEAD
=======
     *
     * @return static
>>>>>>> 8055579 (.)
     */
    public function login(): static
    {
        return $this->state(fn (array $attributes): array => [
            'type' => 'login',
        ]);
    }

    /**
     * Set the authentication type to logout.
<<<<<<< HEAD
=======
     *
     * @return static
>>>>>>> 8055579 (.)
     */
    public function logout(): static
    {
        return $this->state(fn (array $attributes): array => [
            'type' => 'logout',
            'logout_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ]);
    }

    /**
     * Create authentication record for a specific user.
<<<<<<< HEAD
=======
     *
     * @param User $user
     * @return static
>>>>>>> 8055579 (.)
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes): array => [
            'authenticatable_type' => User::class,
            'authenticatable_id' => $user->id,
        ]);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 8055579 (.)
