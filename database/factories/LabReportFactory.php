<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\LabReport;

class LabReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LabReport::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'patient_id' => $this->faker->randomNumber(),
            'lab_report_name' => $this->faker->word(),
            'description' => $this->faker->text(),
            'lab_image' => $this->faker->word(),
        ];
    }
}
