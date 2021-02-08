<?php

namespace Database\Factories;

use App\Models\StartDate;
use Illuminate\Database\Eloquent\Factories\Factory;

class StartDateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StartDate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word()
        ];
    }
}
