<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobCircularFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle() . ' — ' . fake()->randomElement(['BCS', 'Bank', 'NGO']) . ' Circular',
            'company_name' => fake()->company(),
            'category' => fake()->randomElement(['BCS', 'Govt Bank', 'Non-Govt', 'Engineering', 'NGO']),
            'description' => fake()->paragraphs(3, true),
            'deadline' => fake()->dateTimeBetween('-10 days', '+30 days'),
            'user_id' => 1, // Assumes the admin user we seeded in Step C5 has ID 1
        ];
    }
}