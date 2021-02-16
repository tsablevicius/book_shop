<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition(): array
    {
        $name = [];

        for ($i = 0; $i <= random_int(1,3); $i++) {
            $name[] = $this->faker->name;
        }
        return [
            'author' => implode(', ', $name),
        ];
    }
}
