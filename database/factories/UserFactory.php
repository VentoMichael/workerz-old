<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'picture' => $this->faker->imageUrl($width = 640, $height = 480, 'cats'),
            'name' => $this->faker->name,
            'surname' => $this->faker->name,
            'province_id' => $this->faker->numberBetween($min = 1, $max = 11),
            'category_id' => $this->faker->numberBetween($min = 1, $max = 24),
            'plan_user_id' => $this->faker->numberBetween($min = 1, $max = 3),
            'role_id' => $this->faker->numberBetween($min = 1, $max = 2),
            'description' => $this->faker->text($maxNbChars = 200),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
