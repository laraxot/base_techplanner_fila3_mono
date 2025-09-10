<?php

declare(strict_types=1);

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Models\Notification;
use Modules\User\Models\User;

/**
 * Notification Factory
<<<<<<< HEAD
 * 
 * Factory for creating Notification model instances for testing and seeding.
 * 
=======
 *
 * Factory for creating Notification model instances for testing and seeding.
 *
>>>>>>> 9831a351 (.)
 * @extends Factory<Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
<<<<<<< HEAD
     * 
=======
     *
>>>>>>> 9831a351 (.)
     * @var class-string<Notification>
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'type' => $this->faker->randomElement([
                'App\\Notifications\\UserRegistered',
                'App\\Notifications\\PasswordReset',
                'App\\Notifications\\AppointmentReminder',
                'App\\Notifications\\SystemUpdate',
            ]),
            'notifiable_type' => User::class,
            'notifiable_id' => User::factory(),
            'data' => [
                'title' => $this->faker->sentence(4),
                'message' => $this->faker->text(200),
                'action_url' => $this->faker->optional()->url(),
                'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            ],
            'read_at' => $this->faker->optional(0.3)->dateTimeBetween('-1 month', 'now'),
        ];
    }

    /**
     * Create an unread notification.
<<<<<<< HEAD
     *
     * @return static
=======
>>>>>>> 9831a351 (.)
     */
    public function unread(): static
    {
        return $this->state(fn (array $attributes): array => [
            'read_at' => null,
        ]);
    }

    /**
     * Create a read notification.
<<<<<<< HEAD
     *
     * @return static
=======
>>>>>>> 9831a351 (.)
     */
    public function read(): static
    {
        return $this->state(fn (array $attributes): array => [
            'read_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ]);
    }

    /**
     * Create notification for a specific user.
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
            'notifiable_type' => User::class,
            'notifiable_id' => $user->id,
        ]);
    }

<<<<<<< HEAD
         /**
      * Create notification with high priority.
      *
      * @return static
      */
     public function highPriority(): static
     {
         return $this->state(fn (array $attributes): array => [
             'data' => array_merge(
                 is_array($attributes['data'] ?? null) ? $attributes['data'] : [
                     'title' => $this->faker->sentence(4),
                     'message' => $this->faker->text(200),
                     'action_url' => $this->faker->optional()->url(),
                     'priority' => 'medium',
                 ],
                 [
                     'priority' => 'high',
                 ]
             ),
         ]);
     }

    /**
     * Create notification with specific type.
     *
     * @param string $type
     * @return static
=======
    /**
     * Create notification with high priority.
     */
    public function highPriority(): static
    {
        return $this->state(fn (array $attributes): array => [
            'data' => array_merge(
                is_array($attributes['data'] ?? null) ? $attributes['data'] : [
                    'title' => $this->faker->sentence(4),
                    'message' => $this->faker->text(200),
                    'action_url' => $this->faker->optional()->url(),
                    'priority' => 'medium',
                ],
                [
                    'priority' => 'high',
                ]
            ),
        ]);
    }

    /**
     * Create notification with specific type.
>>>>>>> 9831a351 (.)
     */
    public function ofType(string $type): static
    {
        return $this->state(fn (array $attributes): array => [
            'type' => $type,
        ]);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 9831a351 (.)
