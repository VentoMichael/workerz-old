<?php

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->text($maxNbChars = 200),
            'category_id' => $this->faker->numberBetween($min = 1, $max = 27),
            'province_id' => $this->faker->numberBetween($min = 1, $max = 11),
            'user_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'is_draft' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'plan_announcement_id'=> $this->faker->numberBetween($min = 1, $max = 3),
        ];
    }
}
