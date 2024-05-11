<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Appointment;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'doctor_id' => $this->faker->randomNumber(),
            'patient_id' => $this->faker->randomNumber(),
            'appointment_payment_amount' => $this->faker->word(),
            'appointment_payment_status' => $this->faker->randomElement(["paid","unpaid"]),
            'appointment_payment_mode' => $this->faker->randomElement(["online","offline"]),
            'status' => $this->faker->randomElement(["booked","cancelled","completed"]),
            'appointment_datetime' => $this->faker->date(),
            'appointment_description' => $this->faker->word(),
            'service_id' => $this->faker->randomNumber(),
        ];
    }
}