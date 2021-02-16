<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        $user = User::all()->random();
        $cover = $this->faker->image(storage_path('app/public/cover_images'), 400, 600, 'book');
        return [
            'title'          => $this->faker->company,
            'description'    => $this->faker->paragraph(random_int(1, 5)),
            'price'          => $this->faker->numberBetween(1, 99) . '.' . $this->faker->numberBetween(1, 99),
            'discount'       => $this->faker->optional()->numberBetween(1, 50),
            'year'           => $this->faker->year(),
            'cover_img_path' => preg_replace('/.*cover_images\//', '', $cover),
            'is_confirmed'   => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'user_id'        => $user->id,
        ];
    }
}
