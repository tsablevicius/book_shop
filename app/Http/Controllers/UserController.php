<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEmailRequest;
use App\Models\User;
use App\Repositories\BookRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;
    private $bookRepository;

    public function __construct(UserRepository $userRepository, BookRepository $bookRepository)
    {
        $this->userRepository = $userRepository;
        $this->bookRepository = $bookRepository;
    }

    public function profile()
    {
        $user = $this->userRepository->getUserWithBooks(auth()->user()->id);

        return view('users.my-books', compact('user'));
    }

    public function adminWithAllBooks()
    {
        $books = $this->bookRepository->getAllBooks();

        return view('users.admin-books', compact('books'));
    }

    public function editEmail()
    {
        return view('auth.update-email');
    }

    public function updateEmail(UpdateEmailRequest $request)
    {
        $this->userRepository->update(['email' => $request->input('email')], auth()->user()->id);

        return redirect()->route('profile');
    }
}
