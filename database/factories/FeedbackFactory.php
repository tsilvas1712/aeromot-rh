<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'staf_id' => $this->faker->randomDigitNotNull(),
            'user_id' => $this->faker->randomDigitNotNull(),
            'office' => $this->faker->word(),
            'folloup' => $this->faker->text(),
            'positive_points' => $this->faker->text(),
            'improve_points' => $this->faker->text(),
            'expectations' => $this->faker->text(),
            'staffer' => $this->faker->boolean(50),
            'observations' => $this->faker->text(),
            'rating' => $this->faker->randomElement(['1', '2', '3', '4', '5']),
        ];
    }
}
