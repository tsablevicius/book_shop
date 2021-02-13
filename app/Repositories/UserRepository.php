<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = User::class;
    }

    public function getUserWithBooks($userId): Collection
    {
        return $this->model::with(['books', 'books.authors', 'books.genres'])->where('id', $userId)->get();
    }

    public function getAllUserWithBooks(): Collection
    {
        return $this->model::with(['books', 'books.authors', 'books.genres'])->get();
    }
}
