<?php

namespace Spatie\LivewireComments\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = \Modules\User\Models\User::class;

    public function definition()
    {
        return [
            'email' => $this->faker->email,
            'password' => bcrypt($this->faker->sentence),
        ];
    }
}
