<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => 'Admin',
            'phone' => '0180000000',
            'email' => 'admin@example.com',
            'password' => '$2y$10$jXVY75E1KZJuxHFU.08k6udGe36z0jcwdGuoqGq0BQ/QFBoWCOAKC', // 12345678
            'designation' => 'Software Engineer',
            'status' => '1',
            'roles' => '',
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
