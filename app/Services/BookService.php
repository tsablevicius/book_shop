<?php

namespace App\Services;

use App\Http\Middleware\PreventRequestsDuringMaintenance;
use App\Models\User;
use App\Notifications\BookReportNotification;
use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use App\Repositories\GenreRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

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

    public function getBooks($search = null)
    {
        $books = $this->bookRepository->confirmedBooks($search);

        collect($books->items())->map(function ($book) {
            if ($discount = Arr::get($book, 'discount')) {
                $book['price_with_discount'] = round($book['price'] - ($book['price'] * $discount / 100), 2);
            }

            if (Arr::get($book, 'is_confirmed') && Carbon::parse($book->is_confirmed)->addWeek()->gt(Carbon::now())) {
                $book['new_book'] = true;
            }

            return $book;
        });

        return $books;
    }

    public function getBook($book)
    {
        if (auth()->user()->isOwner($book)) {
            $book = $this->bookRepository->find($book->id);
        } else {
            $book = $this->bookRepository->findConfirmedBook($book->id);
        }

        $book['book_rating'] = $book->reviews->avg('rating');
        $book->reviews->map(function (&$review) {
           $review['author_name'] = $review->user->name;
        });

        return $book;
    }

    public function create($data)
    {
        $book = null;

        DB::transaction( function () use ($data, &$book) {
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
        });


        return $book;
    }

    public function update($data, $id)
    {
        $isUpdated = false;

        DB::transaction( function () use ($data, $id, &$isUpdated) {
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

        });

        return $isUpdated;
    }

    public function sendEmail($data)
    {
        $admin = User::where('role_id', User::ROLE_ADMIN)->get();
        $book = $this->bookRepository->find($data['book_id']);
        Notification::send($admin, new BookReportNotification($book, $data));

        return $book;
    }

    private function handleFileUpload($file)
    {
        $coverName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        $file->storeAs('/public/cover_images', $coverName);

        return $coverName;
    }
}
