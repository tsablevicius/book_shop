<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        $user = User::all()->random();
        return [
            'rating'  => $this->faker->optional()->numberBetween(1, 5),
            'comment' => $this->faker->optional()->paragraph(random_int(1, 3)),
            'user_id' => $user->id,
        ];
    }
}
