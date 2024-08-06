<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_event_id' => $this->faker->numberBetween(1, 10),
            'ticket_email' => $this->faker->safeEmail,
            'ticket_phone' => $this->faker->phoneNumber,
            'ticket_price' => $this->faker->randomFloat(2, 10, 100),
            'ticket_order_id' => $this->faker->numberBetween(1, 20),
            'ticket_key' => $this->faker->uuid,
            'ticket_ticket_type_id' => $this->faker->numberBetween(1, 5),
            'ticket_status' => $this->faker->randomElement(['active', 'validated', 'expired', 'cancelled']),
            'ticket_created_on' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
