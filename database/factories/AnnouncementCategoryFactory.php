<?php

namespace Database\Factories;

use App\Models\AnnouncementCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AnnouncementCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'announcement_id' => $this->faker->numberBetween($min = 1, $max = 100),
            'category_id' => $this->faker->numberBetween($min = 1, $max = 24),
        ];
    }
}
