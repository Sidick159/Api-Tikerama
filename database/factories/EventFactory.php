<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_category' => $this->faker->randomElement(['Autre', 'Concert-Spectable', 'Diner Gala', 'Festival', 'Formation']),
            'event_title' => $this->faker->words(2, true), // Un titre de 3 mots
            'event_description' => $this->faker->text(), // Description longue
            'event_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'), // Une date entre 1 semaine et 1 mois
            'event_image' => $this->faker->imageUrl(800, 600, 'events', true, 'event'), // URL d'une image
            'event_city' => $this->faker->city(), // Ville
            'event_address' => $this->faker->address(), // Adresse
            'event_status' => $this->faker->randomElement(['Upcoming', 'Completed', 'Cancelled']),
            'event_created_on' => $this->faker->dateTimeThisYear(), // Date de création cette année
        ];
    }
}
