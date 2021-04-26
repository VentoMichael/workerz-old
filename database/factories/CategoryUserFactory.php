<?php

namespace Database\Factories;

use App\Models\CategoryUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'category_id' => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
