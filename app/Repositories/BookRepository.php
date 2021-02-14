<?php

namespace App\Repositories;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class BookRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = Book::class;
    }

    public function confirmedBooks(): Collection
    {
        return $this->model::with(['authors:author', 'genres:genre'])->whereNotNull('is_confirmed')->get();
    }

    public function findConfirmedBook(int $id)
    {
        return $this->model::with(['authors:author', 'genres:genre', 'reviews'])->whereNotNull('is_confirmed')->findOrfail($id);
    }

    public function confirm($id)
    {
        return $this->model::find($id)->update(['is_confirmed' => Carbon::now()]);
    }

    public function getAllBooks()
    {
        return $this->model::with(['authors:author', 'genres:genre'])->get();
    }

    public function addRelatedData($book)
    {
        $book['author'] = $this->model::find($book->id)->authors->implode('author', ', ');
        $book['genre'] = $this->model::find($book->id)->genres->implode('genre', ', ');

        return $book;
    }
}
