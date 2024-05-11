<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Doctor;
use App\Models\Patient;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'specialization_id' => $this->faker->randomNumber(),
            'doctor_image' => $this->faker->word(),
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'gender' => $this->faker->randomElement(["male","female","other"]),
            'dob' => $this->faker->date(),
            'years_of_experience' => $this->faker->numberBetween(-10000, 10000),
            'address' => $this->faker->word(),
            'appointment_id' => $this->faker->randomNumber(),
            'patient_id' => Patient::factory(),
        ];
    }
}
