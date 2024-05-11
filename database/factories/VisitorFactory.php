<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Visitor;

class VisitorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visitor::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'status' => $this->faker->randomElement(["checked_in","completed"]),
            'phone' => $this->faker->phoneNumber(),
            'gender' => $this->faker->randomElement(["male","female","other"]),
            'dob' => $this->faker->date(),
            'description' => $this->faker->text(),
            'visitor_date' => $this->faker->date(),
            'visitor_payment' => $this->faker->randomFloat(2, 0, 99999999.99),
        ];
    }
}
