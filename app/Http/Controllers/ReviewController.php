<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Repositories\BookRepository;
use App\Repositories\ReviewRepository;

class ReviewController extends Controller
{
    private $reviewRepository;
    private $bookRepository;

    public function __construct(ReviewRepository $reviewRepository, BookRepository $bookRepository)
    {
        $this->reviewRepository = $reviewRepository;
        $this->bookRepository = $bookRepository;
    }

    public function store(ReviewRequest $request)
    {
        $this->reviewRepository->createReview($request->validated());
        $book = $this->bookRepository->find($request->book_id);

        return redirect()->route('books.show', ['book' => $book]);
    }
}
