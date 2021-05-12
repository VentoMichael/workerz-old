<?php

namespace Database\Factories;

use App\Models\PhysicalAdress;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhysicalAdressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PhysicalAdress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'postal_adress' => $this->faker->text($maxNbChars = 50),
            'user_id' => $this->faker->numberBetween($min = 1, $max = 99),
            'province_id' => $this->faker->numberBetween($min = 1, $max = 11),
        ];
    }
}
