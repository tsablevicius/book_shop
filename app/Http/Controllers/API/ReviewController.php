<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Repositories\ReviewRepository;

class ReviewController extends Controller
{
    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function store(ReviewRequest $request)
    {
        return $this->reviewRepository->createReview($request->validated());
    }
}
