<?php

declare(strict_types=1);

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Models\OauthClient;
use Modules\User\Models\User;

/**
 * OauthClient Factory
<<<<<<< HEAD
 * 
 * Factory for creating OauthClient model instances for testing and seeding.
 * 
=======
 *
 * Factory for creating OauthClient model instances for testing and seeding.
 *
>>>>>>> 9831a351 (.)
 * @extends Factory<OauthClient>
 */
class OauthClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 9831a351 (.)
     * @var class-string<OauthClient>
     */
    protected $model = OauthClient::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'user_id' => $this->faker->optional()->randomElement([User::factory(), null]),
<<<<<<< HEAD
            'name' => $this->faker->company() . ' App',
=======
            'name' => $this->faker->company().' App',
>>>>>>> 9831a351 (.)
            'secret' => $this->faker->sha256(),
            'provider' => $this->faker->optional()->randomElement(['users', 'admins']),
            'redirect' => $this->faker->url(),
            'personal_access_client' => $this->faker->boolean(20), // 20% personal access clients
            'password_client' => $this->faker->boolean(30), // 30% password clients
            'revoked' => $this->faker->boolean(5), // 5% revoked
            'grant_types' => $this->faker->optional()->randomElements([
                'authorization_code',
                'client_credentials',
                'password',
<<<<<<< HEAD
                'refresh_token'
            ], $this->faker->numberBetween(1, 3)),
            'scopes' => $this->faker->optional()->randomElements([
                'read', 'write', 'admin', 'user'
=======
                'refresh_token',
            ], $this->faker->numberBetween(1, 3)),
            'scopes' => $this->faker->optional()->randomElements([
                'read', 'write', 'admin', 'user',
>>>>>>> 9831a351 (.)
            ], $this->faker->numberBetween(1, 3)),
        ];
    }

    /**
     * Create a personal access client.
<<<<<<< HEAD
     *
     * @return static
=======
>>>>>>> 9831a351 (.)
     */
    public function personalAccess(): static
    {
        return $this->state(fn (array $attributes): array => [
            'personal_access_client' => true,
            'password_client' => false,
            'name' => 'Personal Access Client',
        ]);
    }

    /**
     * Create a password client.
<<<<<<< HEAD
     *
     * @return static
=======
>>>>>>> 9831a351 (.)
     */
    public function password(): static
    {
        return $this->state(fn (array $attributes): array => [
            'password_client' => true,
            'personal_access_client' => false,
            'name' => 'Password Grant Client',
        ]);
    }

    /**
     * Create a revoked client.
<<<<<<< HEAD
     *
     * @return static
=======
>>>>>>> 9831a351 (.)
     */
    public function revoked(): static
    {
        return $this->state(fn (array $attributes): array => [
            'revoked' => true,
        ]);
    }

    /**
     * Create an active client.
<<<<<<< HEAD
     *
     * @return static
=======
>>>>>>> 9831a351 (.)
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes): array => [
            'revoked' => false,
        ]);
    }

    /**
     * Create client for a specific user.
<<<<<<< HEAD
     *
     * @param User $user
     * @return static
=======
>>>>>>> 9831a351 (.)
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes): array => [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Create client with specific redirect URI.
<<<<<<< HEAD
     *
     * @param string $redirectUri
     * @return static
=======
>>>>>>> 9831a351 (.)
     */
    public function withRedirectUri(string $redirectUri): static
    {
        return $this->state(fn (array $attributes): array => [
            'redirect' => $redirectUri,
        ]);
    }

    /**
     * Create client with specific scopes.
     *
<<<<<<< HEAD
     * @param array<string> $scopes
     * @return static
=======
     * @param  array<string>  $scopes
>>>>>>> 9831a351 (.)
     */
    public function withScopes(array $scopes): static
    {
        return $this->state(fn (array $attributes): array => [
            'scopes' => $scopes,
        ]);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 9831a351 (.)
