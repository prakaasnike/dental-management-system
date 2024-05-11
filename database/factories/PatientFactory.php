<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Patient;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'patient_image' => $this->faker->word(),
            'patient_before_image' => $this->faker->word(),
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'gender' => $this->faker->randomElement(["male","female","other"]),
            'dob' => $this->faker->date(),
            'blood_type' => $this->faker->randomElement(["A+","A-","B+","B-","AB+","AB-","O+","O-"]),
            'address' => $this->faker->word(),
            'registered_date' => $this->faker->date(),
            'payment_id' => $this->faker->randomNumber(),
            'appointment_id' => $this->faker->randomNumber(),
        ];
    }
}
