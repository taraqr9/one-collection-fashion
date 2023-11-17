<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Developer',
            'phone' => '01800000000',
            'email' => 'developers@jatri.co',
            'password' => '$2y$10$jXVY75E1KZJuxHFU.08k6udGe36z0jcwdGuoqGq0BQ/QFBoWCOAKC', // 12345678
            'designation' => 'Software Engineer',
            'status' => '1',
            'roles' => '[1,2,3,4,5,6,7,8,9,10]',
            'admin_type' => 'SYSTEM_ADMIN',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
