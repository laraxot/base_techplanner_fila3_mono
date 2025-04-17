<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\TechPlanner\Models\PhoneCall;

class PhoneCallFactory extends Factory
{
    protected $model = PhoneCall::class;

    public function definition(): array
    {
        return [
            'client_id' => \Modules\TechPlanner\Models\Client::factory(),
            'date' => $this->faker->dateTimeThisYear(),
            'duration' => $this->faker->numberBetween(60, 3600),  // durata tra 1 minuto e 1 ora
            'notes' => $this->faker->optional()->text(),
            'call_type' => $this->faker->randomElement(['inbound', 'outbound']),
        ];
    }
}
