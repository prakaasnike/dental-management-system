<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Service;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'service_image' => $this->faker->word(),
            'service_name' => $this->faker->word(),
            'service_amount' => $this->faker->word(),
            'service_description' => $this->faker->word(),
        ];
    }
}
