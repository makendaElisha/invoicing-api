<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\BankingDetails;
use App\Models\Branding;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BankingDetailsFactory>
 */
class BankingDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bank_name' => $this->faker->company(),
            'account_holder' => $this->faker->name(),
            'account_number' => $this->faker->bankAccountNumber(),
            'branch_code' => $this->faker->swiftBicNumber(),
            'currency' => $this->faker->currencyCode()
        ];
    }
}
