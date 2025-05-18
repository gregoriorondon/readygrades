<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'primer-name' => fake()->firstName(),
            'segundo-name' => fake()->firstName(),
            'primer-apellido' => fake()->lastName(),
            'segundo-apellido' => fake()->lastName(),
            'genero' => 'masculino',
            'nacionalidad' => 'VE',
            'cedula' => '12345678',
            'email' => 'admin@admin',
            'password' => '$2y$12$xLsAjv/AEOJBAUXTYAhgFO3ifCm9y6oo8gcU8PAE28zYnQ62s5YAe',
            'nucleo_id' => '1',
        ];
    }
}
