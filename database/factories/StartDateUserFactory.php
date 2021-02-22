<?php

namespace Database\Factories;

use App\Models\StartDateUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class StartDateUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StartDateUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'start_date_id' => $this->faker->numberBetween($min = 1, $max = 7),
        ];
    }
}
