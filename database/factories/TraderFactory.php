<?php

namespace Database\Factories;

use App\Models\Trader;
use Illuminate\Database\Eloquent\Factories\Factory;

class TraderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trader::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'thumbnail' => $this->faker->imageUrl(200, 200, 'avatars'),
            'nationality' => $this->faker->countryCode,
            'returns' => $this->faker->randomFloat(2, 10, 100),
            'duration' => $this->faker->randomDigit,
            'duration_' => $this->faker->randomElement(array('days', 'weeks', 'months', 'years')),
            'experience' => '2 Years',
            'mbg' => $this->faker->randomFloat(2, 10, 100),
            'rating' => $this->faker->randomFloat(2, 4, 10),
        ];
    }
}