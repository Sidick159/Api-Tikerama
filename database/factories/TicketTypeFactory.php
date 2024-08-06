<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketType>
 */
class TicketTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_type_event_id' => $this->faker->numberBetween(1, 100), // Assure-toi que les IDs d'événements existent
            'ticket_type_name' => $this->faker->word(), // Un nom pour le type de ticket
            'ticket_type_price' => $this->faker->numberBetween(10, 500), // Prix entre 10 et 500
            'ticket_type_quantity' => $this->faker->numberBetween(1, 100), // Quantité entre 1 et 100
            'ticket_type_real_quantity' => $this->faker->numberBetween(1, 100), // Quantité réelle entre 1 et 100
            'ticket_type_total_quantity' => $this->faker->numberBetween(1, 100), // Quantité totale entre 1 et 100
            'ticket_type_description' => $this->faker->text(), // Description longue
        ];
    }
}
