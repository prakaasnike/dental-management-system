<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CompletedTreatment;

class CompletedTreatmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompletedTreatment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'patient_id' => $this->faker->randomNumber(),
            'doctor_id' => $this->faker->randomNumber(),
            'treatment_name' => $this->faker->word(),
            'payment_id' => $this->faker->randomNumber(),
        ];
    }
}
