<?php

namespace Database\Factories;

use App\Models\Election;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ElectionFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-1 week', '+1 week');
        $end = (clone $start)->modify('+' . fake()->numberBetween(1, 14) . ' days');

        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'start_date' => $start,
            'end_date' => $end,
            'status' => fake()->randomElement(['draft', 'upcoming', 'active', 'closed']),
            'created_by' => User::where('is_admin', true)->inRandomOrder()->value('id'),
        ];
    }
}