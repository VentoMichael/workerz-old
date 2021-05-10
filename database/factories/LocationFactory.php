<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'province_id' => $this->faker->numberBetween($min = 1, $max = 11),
            'physical_adress_id' => $this->faker->numberBetween($min = 1, $max = 100),
        ];
    }
}
