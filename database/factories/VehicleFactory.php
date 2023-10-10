<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $stadt = fake()->randomElement(['HH', 'B', 'HB', 'M', 'A']);
        $ext = fake()->randomElement(['AB', 'CD', 'EF', 'GH', 'IJ', 'KL', 'MN']);
        $nr = fake()->randomNumber(3, false);
        $registration = $stadt.':'.$ext.' '.$nr;

        return [
            'registration' => $registration,
            'brand' => fake()->randomElement(['Fiat', 'Ford', 'Mercedes', 'Renault', 'Dacia']), 
            'type' => fake()->randomElement(['Keinwagen', 'Mittelklasse', 'Oberklasse', 'Luxuswagen']), 
            'description' => fake()->words(5, true),
            'status' => fake()->randomElement(['Ready', 'Blocked', 'Broken']),  
        ];
    }
}
