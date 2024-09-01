<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'client_type' => $this->faker->randomElement(['Individual', 'Company']),
            'organization_name' => $this->faker->company(),
            'client_name' => $this->faker->firstName(),
            'client_last_name' => $this->faker->lastName(),
            'business_type' => $this->faker->randomElement(['Retail', 'Wholesale', 'Manufacturing', 'Service']),
            'service_rendered' => $this->faker->bs(),
            'company_registration' => $this->faker->ssn(),
            'reference_prefix' => $this->faker->word(),
            'address_id' => $this->faker->numberBetween(1, 1000),
            'cell_number' => $this->faker->phoneNumber(),
            'telephone_number' => $this->faker->phoneNumber(),
            'vat_number' => 'VAT' . strtoupper($this->faker->bothify('##??###')),
            'email' => $this->faker->unique()->safeEmail(),
            'website_url' => $this->faker->url(),
        ];
    }
}
