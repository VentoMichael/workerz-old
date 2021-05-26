<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'created_at' => $this->faker->dateTime($max = 'now', $timezone = null),
            'from_id' => $this->faker->numberBetween($min = 1, $max = 100),
            'to_id' => $this->faker->numberBetween($min = 1, $max = 100)
        ];
    }
}
