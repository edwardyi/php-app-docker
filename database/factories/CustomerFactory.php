<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_id' => Company::factory()->create(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'active' => 1
        ];
    }
}
