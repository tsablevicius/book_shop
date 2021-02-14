<?php

namespace App\Repositories;

use App\Models\Review;

class ReviewRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = Review::class;
    }

    public function createReview($data)
    {
        $data['user_id'] = auth()->user()->id;

        return $this->create($data);
    }
}
