<?php

namespace Database\Factories;

use App\Models\StartDateAnnouncement;
use Illuminate\Database\Eloquent\Factories\Factory;

class StartDateAnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StartDateAnnouncement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'announcement_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'start_date_id' => $this->faker->numberBetween($min = 1, $max = 7),
        ];
    }
}
