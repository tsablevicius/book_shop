<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Repositories\BookRepository;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $bookService;
    private $bookRepository;

    public function __construct(BookService $bookService, BookRepository $bookRepository)
    {
        $this->bookService = $bookService;
        $this->bookRepository = $bookRepository;
    }

    public function index()
    {
        $books = $this->bookService->getBooks();

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.form');
    }

    public function store(BookCreateRequest $request)
    {
        $this->bookService->create($request->validated());

        return redirect()->route('profile');
    }

    public function show(Book $book)
    {
        $book = $this->bookRepository->findConfirmedBook($book->id);

        return view('books.book', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.form', compact('book'));
    }

    public function update(BookCreateRequest $request, Book $book)
    {
        $this->bookService->update($request->validated(), $book->id);

        return redirect()->route('profile');
    }

    public function destroy(Book $book)
    {
        $this->bookRepository->delete($book->id);

        return redirect()->route('profile');
    }

    public function confirm(BookRequest $request)
    {
        $this->bookRepository->confirm((int)$request->input('id'));

        return redirect()->route('profile');
    }
}
