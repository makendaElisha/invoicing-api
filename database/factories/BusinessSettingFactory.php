<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\BankingDetails;
use App\Models\Branding;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusinessSettingFactory>
 */
class BusinessSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address_id' => Address::inRandomOrder()->value('id'),
            'branding_id' => Branding::inRandomOrder()->value('id'),
            'business_name' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'industry' => $this->faker->word(),
            'contact_person_name' => $this->faker->name(),
            'contact_person_role' => $this->faker->jobTitle(),
            'reference_prefix' => strtoupper($this->faker->lexify('???')),
            'company_registration' => $this->faker->numerify('REG-#####'),
            'rendering_service' => $this->faker->word(),
            'vat_number' => $this->faker->numerify('VAT-########'),
            'cell_number' => $this->faker->phoneNumber(),
            'telephone_number' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'website_url' => $this->faker->url(),
            'notes' => $this->faker->sentence(),
            'banking_details_id' => BankingDetails::inRandomOrder()->value('id'),
            'custom_fields' => json_encode($this->faker->words(3, true)),
        ];
    }
}
