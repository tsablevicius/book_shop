<?php

namespace App\Repositories;

use App\Models\Book;
use Carbon\Carbon;

class BookRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = Book::class;
    }

    public function confirmedBooks($search = null)
    {
        $query = $this->model::with(['authors:author', 'genres:genre'])
            ->whereNotNull('is_confirmed');

        if ($search) {
            $query->where('title', 'LIKE', "{$search}%")
                ->orWhereHas('authors', function ($query) use ($search) {
                    $query->where('author',  'LIKE', "{$search}%");
                });
        }

        return $query->simplePaginate(25);
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
