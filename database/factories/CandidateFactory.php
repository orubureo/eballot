<?php

namespace Database\Factories;

use App\Models\Election;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'election_id' => Election::factory(),
            'full_name' => fake()->name(),
            'bio' => fake()->sentence(10),
        ];
    }
}