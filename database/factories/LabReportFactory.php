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
            'lab_image' => $this->faker->imageUrl(function ($record) {
                // Generate random name for the avatar
                $name = $record->name ?: 'Unknown';
                // Construct the URL with the random name
                return 'https://api.dicebear.com/8.x/initials/svg?seed=' . urlencode($name);
            }),
        ];
    }
}
