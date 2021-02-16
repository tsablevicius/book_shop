<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::factory()->count(5)->create()->each(function ($book) {
            $authors = Author::factory()->make();
            $book->authors()->save($authors);

            $reviews = Review::factory()->count(5)->make();
            $book->reviews()->saveMany($reviews);
        });
    }
}
