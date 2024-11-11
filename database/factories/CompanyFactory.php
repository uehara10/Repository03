<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = \App\Models\Company::class;

    public function definition()
    {
        return [
            'company_name' => $this->faker->company,
            'street_address' => $this->faker->address,
            'representative_name' => $this->faker->name,
        ];
    }
}
