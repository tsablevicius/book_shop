<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class GenreFactory extends Factory
{
    protected $model = Genre::class;

    protected $exampleGenres = [
        'Action and adventure',
        'Art/architecture',
        'Alternate history',
        'Autobiography',
        'Anthology',
        'Biography',
        'Chick lit',
        'Business/economics',
        'Children\'s',
        'Crafts/hobbies',
        'Classic',
        'Cookbook',
        'Comic book',
        'Diary',
        'Coming-of-age',
        'Dictionary',
        'Crime',
        'Encyclopedia'
    ];

    public function definition(): array
    {
        $genres = [];
        $exampleGenresCount = count($this->exampleGenres) - 1;

        for ($i = 0; $i <= random_int(1,3); $i++) {
            $genres[] = $this->exampleGenres[random_int(0, $exampleGenresCount)];
        }
        return [
            'genre' => implode(', ', $genres),
        ];
    }
}
