<?php

namespace Database\Factories;

use App\Models\Client; // Import Model Client
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'no_phone' => fake()->phoneNumber(), // Anda bisa gunakan faker phone number yang lebih sesuai dengan format ID jika perlu
            'photo_profile' => null, // Bisa diisi null atau path gambar default jika ada
            'institution' => fake()->company(),
            'subscribe_status' => fake()->randomElement(['Aktif', 'Non Aktif']),
            'subscription_start_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'subscription_end_date' => fake()->dateTimeBetween('now', '+1 year'),
        ];
    }
}