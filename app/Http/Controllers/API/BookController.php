<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Book\BookCollectionResource;
use App\Http\Resources\Api\Book\BookResource;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
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
        return BookCollectionResource::collection($this->bookService->getBooks());
    }

    public function getBook($id)
    {
        $book = (object)['id' => $id];
        return BookResource::make($this->bookService->getBook($book));
    }
}
