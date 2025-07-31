<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\TechPlanner\Models\DeviceVerification;

/**
 * Class DeviceVerificationFactory.
 */
class DeviceVerificationFactory extends Factory
{
    protected $model = DeviceVerification::class;

    public function definition(): array
    {
        return [
            'device_id' => \Modules\TechPlanner\Models\Device::factory(), // Assuming you have a Device model
            'verification_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['pending', 'verified', 'failed']),
        ];
    }
}
