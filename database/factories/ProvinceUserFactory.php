<?php

namespace Database\Factories;

use App\Models\ProvinceUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProvinceUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProvinceUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 100),
            'province_id' => $this->faker->numberBetween($min = 1, $max = 11),
        ];
    }
}
