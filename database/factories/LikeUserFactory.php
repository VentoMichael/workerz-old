<?php

namespace Database\Factories;

use App\Models\LikeUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LikeUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 99),
            'announcement_id' => $this->faker->numberBetween($min = 1, $max = 99),
            'liked' => $this->faker->boolean(50),
        ];
    }
}
