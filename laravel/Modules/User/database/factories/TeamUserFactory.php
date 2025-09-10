<?php

declare(strict_types=1);

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Models\Team;
use Modules\User\Models\TeamUser;
use Modules\User\Models\User;

/**
 * TeamUser Factory
<<<<<<< HEAD
 * 
 * Factory for creating TeamUser model instances for testing and seeding.
 * 
=======
 *
 * Factory for creating TeamUser model instances for testing and seeding.
 *
>>>>>>> 9831a351 (.)
 * @extends Factory<TeamUser>
 */
class TeamUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 9831a351 (.)
     * @var class-string<TeamUser>
     */
    protected $model = TeamUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => Team::factory(),
            'user_id' => User::factory(),
            'role' => $this->faker->randomElement(['owner', 'admin', 'editor', 'member']),
        ];
    }

    /**
     * Create team-user relationship for a specific team.
<<<<<<< HEAD
     *
     * @param Team $team
     * @return static
=======
>>>>>>> 9831a351 (.)
     */
    public function forTeam(Team $team): static
    {
        return $this->state(fn (array $attributes): array => [
            'team_id' => $team->id,
        ]);
    }

    /**
     * Create team-user relationship for a specific user.
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
     * Set the role to owner.
<<<<<<< HEAD
     *
     * @return static
=======
>>>>>>> 9831a351 (.)
     */
    public function owner(): static
    {
        return $this->state(fn (array $attributes): array => [
            'role' => 'owner',
        ]);
    }

    /**
     * Set the role to admin.
<<<<<<< HEAD
     *
     * @return static
=======
>>>>>>> 9831a351 (.)
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes): array => [
            'role' => 'admin',
        ]);
    }

    /**
     * Set the role to member.
<<<<<<< HEAD
     *
     * @return static
=======
>>>>>>> 9831a351 (.)
     */
    public function member(): static
    {
        return $this->state(fn (array $attributes): array => [
            'role' => 'member',
        ]);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 9831a351 (.)
