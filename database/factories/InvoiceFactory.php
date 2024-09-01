<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\BankingDetails;
use App\Models\Branding;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceFactory>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_number' => strtoupper($this->faker->unique()->bothify('INV-#####')),
            'subtotal' => $this->faker->randomFloat(2, 100, 10000),
            'tax' => $this->faker->randomFloat(2, 10, 500),
            'total' => function (array $attributes) {
                return $attributes['subtotal'] + $attributes['tax'] - ($attributes['discount'] ?? 0);
            },
            'discount' => $this->faker->randomFloat(2, 0, 500),
            'client_id' => Client::inRandomOrder()->value('id'),
            'invoiced_on' => $this->faker->date(),
            'due_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'created_by' => User::inRandomOrder()->value('id'),
            'show_shipping' => $this->faker->boolean(),
            'billingto_id' => Address::inRandomOrder()->value('id'),
            'invoice_reference' => $this->faker->optional()->word(),
            'notes' => $this->faker->optional()->sentence(),
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'overdue']),
            'recurring' => $this->faker->boolean(),
            'show_on_pdf' => $this->faker->boolean(),
        ];
    }
}
