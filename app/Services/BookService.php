<?php

namespace App\Services;

use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use App\Repositories\GenreRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class BookService
{
    private $bookRepository;
    private $authorRepository;
    private $genreRepository;

    public function __construct(
        BookRepository $bookRepository,
        AuthorRepository $authorRepository,
        GenreRepository $genreRepository
    )
    {
        $this->bookRepository = $bookRepository;
        $this->authorRepository = $authorRepository;
        $this->genreRepository = $genreRepository;
    }

    public function getBooks($search = null): Collection
    {
        return $this->bookRepository->confirmedBooks($search)->map(function ($book) {
            if ($discount = Arr::get($book, 'discount')) {
                $book['price_with_discount'] = round($book['price'] - ($book['price'] * $discount / 100), 2);
            }

            if (Arr::get($book, 'is_confirmed') && Carbon::parse($book->is_confirmed)->addWeek()->gt(Carbon::now())) {
                $book['new_book'] = true;
            }

            return $book;
        });
    }

    public function getBook($id)
    {
        $book = $this->bookRepository->findConfirmedBook($id);

        $book['book_rating'] = $book->reviews->avg('rating');
        $book->reviews->map(function (&$review) {
           $review['author_name'] = $review->user->name;
        });

        return $book;
    }

    public function create($data)
    {
        //TODO add into transaction
        $coverName = $this->handleFileUpload(Arr::get($data, 'cover_img_path'));
        $data['cover_img_path'] = $coverName;
        $data['user_id'] = auth()->user()->id;

        $book = $this->bookRepository->create($data);

        $authors = explode(',', Arr::get($data, 'author'));
        collect($authors)->each(function ($author) use ($book) {
            $author = $this->authorRepository->createIfNotExist(['author' => trim($author)]);
            $book->authors()->attach($author);
        });

        $genres = explode(',', Arr::get($data, 'genre'));
        collect($genres)->each(function ($genre) use ($book) {
            $genre = $this->genreRepository->createIfNotExist(['genre' => trim($genre)]);
            $book->genres()->attach($genre);
        });

        return $book;
    }

    public function update($data, $id)
    {
        //TODO add into transaction
        $coverName = $this->handleFileUpload(Arr::get($data, 'cover_img_path'));
        $data['cover_img_path'] = $coverName;

        $isUpdated = $this->bookRepository->update($data, $id);
        $book = $this->bookRepository->find($id);

        $authors = explode(',', Arr::get($data, 'author'));
        collect($authors)->each(function ($author) use ($book) {
            $author = $this->authorRepository->createIfNotExist(['author' => trim($author)]);
            $book->authors()->sync($author);
        });

        $genres = explode(',', Arr::get($data, 'genre'));
        collect($genres)->each(function ($genre) use ($book) {
            $genre = $this->genreRepository->createIfNotExist(['genre' => trim($genre)]);
            $book->genres()->sync($genre);
        });

        return $isUpdated;
    }

    private function handleFileUpload($file)
    {
        $coverName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        $file->storeAs('/public/cover_images', $coverName);

        return $coverName;
    }
}
