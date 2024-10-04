<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->city, // Utilisation du faker pour générer un nom de ville
            'state' => $this->faker->state, // Générer un état fictif
            'longitude' => $this->faker->longitude, // Générer une longitude fictive
            'latitude' => $this->faker->latitude, // Générer une latitude fictive
        ];
    }
}
