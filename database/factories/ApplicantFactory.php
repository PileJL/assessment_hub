<?php

namespace Database\Factories;

use App\Models\Applicant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Applicant>
 */
class ApplicantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fullName' => fake()->name(),
            'isPassed' => fake()->randomElement([0,1]),
            'height' => fake()->randomElement([1.70, 1.60, 1.30, 1.80]),
            'weight' => fake()->randomElement([65, 50, 55, 70]),
            'timestampCreatedAt' => $this->faker->dateTimeBetween('-2 month', 'now'),
        ];
    }
}
