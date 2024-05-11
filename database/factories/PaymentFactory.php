<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Payment;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'patient_id' => $this->faker->randomNumber(),
            'appointment_id' => $this->faker->randomNumber(),
            'patient_total_amount_to_be_paid' => $this->faker->word(),
            'patient_initial_deposit' => $this->faker->word(),
            'appointment_payment_amount' => $this->faker->word(),
            'appointment_payment_status' => $this->faker->randomElement(["paid","unpaid"]),
            'appointment_payment_mode' => $this->faker->randomElement(["online","offline"]),
            'total_service_charge_amount' => $this->faker->word(),
            'patients_total_appointment_amount_deposits' => $this->faker->word(),
            'patient_remaining_amount' => $this->faker->word(),
            'total_payments' => $this->faker->word(),
        ];
    }
}
