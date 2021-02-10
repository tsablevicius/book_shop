<?php

namespace App\Services;

use App\Repositories\BookRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class BookService
{
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getBooks(): Collection
    {
        return $this->bookRepository->confirmedBooks()->map(function ($book) {
            if ($discount = Arr::get($book, 'discount')) {
                $book['price_with_discount'] = round($book['price'] - ($book['price'] * $discount / 100), 2);
            }

            if (Arr::get($book, 'is_confirmed') && Carbon::parse($book->is_confirmed)->addWeek()->gt(Carbon::now())) {
                $book['new_book'] = true;
            }

            return $book;
        });
    }

    public function create($data)
    {
        $coverName = $this->handleFileUpload(Arr::get($data, 'cover_img_path'));

        $data['cover_img_path'] = $coverName;
        $data['user_id'] = auth()->user()->id;

        return $this->bookRepository->create($data);
    }

    public function update($data, $id)
    {
        $coverName = $this->handleFileUpload(Arr::get($data, 'cover_img_path'));
        $data['cover_img_path'] = $coverName;

        return $this->bookRepository->update($data, $id);

    }

    private function handleFileUpload($file)
    {
        $coverName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        $file->storeAs('/public/cover_images', $coverName);

        return $coverName;
    }
}
