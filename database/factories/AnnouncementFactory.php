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
            'slug' => $this->faker->slug,
            'job' => $this->faker->word,
            'picture' => $this->faker->imageUrl($width = 640, $height = 480, 'cats'),
            'description' => $this->faker->text($maxNbChars = 200),
            'province_id' => $this->faker->numberBetween($min = 1, $max = 11),
            'start_month_id' => $this->faker->numberBetween($min = 1, $max = 12),
            'pricemax' => $this->faker->numberBetween($min = 10, $max = 100),
            'user_id' => $this->faker->numberBetween($min = 1, $max = 100),
            'is_draft' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'is_payed' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'plan_announcement_id'=> $this->faker->numberBetween($min = 1, $max = 3),
        ];
    }
}
