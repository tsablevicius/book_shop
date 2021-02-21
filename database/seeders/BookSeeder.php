<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::factory()->count(30)->create()->each(function ($book) {
            $authors = Author::factory()->make();
            $book->authors()->save($authors);

            $genres = Genre::factory()->make();
            $book->genres()->save($genres);

            $reviews = Review::factory()->count(15)->make();
            $book->reviews()->saveMany($reviews);
        });
    }
}
