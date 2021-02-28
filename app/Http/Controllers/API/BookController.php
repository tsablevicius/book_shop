<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Book\BookResource;
use App\Http\Resources\ReviewResource;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function getBooks()
    {
        return BookResource::collection($this->bookService->getBooks());
    }

    public function getBook($id)
    {
        $book = (object)['id' => $id];
        return BookResource::make($this->bookService->getBook($book)->append('description'));
    }

    public function getReviews($id)
    {
        $book = (object)['id' => $id];
        return ReviewResource::make($this->bookService->getBook($book));
    }
}
