<?php

namespace App\Repositories;

use App\Models\Genre;

class GenreRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = Genre::class;
    }
}
