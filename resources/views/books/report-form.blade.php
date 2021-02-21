@extends('layouts.app')
@section('content')

<div class="container mt-8 mx-auto max-w-xl">
    <h2 class="text-2xl text-gray-900 font-medium title-font mb-2">
        Report a book: {{ $book->title }}
    </h2>
    <form action="{{route('books.send-report')}}" method="POST">
        @csrf
        <input type="hidden"
               name="book_id"
               value="{{ $book->id }}">

        <input id="email" type="email"
               class="mt-4 form-input w-full border border-gray-500 @error('rating') border-red-500 @enderror"
               name="email"
               value="{{ auth()->user()->email }}"
               placeholder="Email">
        @error('rating')
        <p class="text-red-500 text-xs italic mt-2">
            {{ $message }}
        </p>
        @enderror

        <input id="comment" type="text"
               class="mt-4 form-input w-full border border-gray-500 @error('comment') border-red-500 @enderror"
               name="comment"
               value="{{ old('comment') }}"
               placeholder="Comment">
        @error('comment')
        <p class="text-red-500 text-xs italic mt-2">
            {{ $message }}
        </p>
        @enderror

        <div class="flex justify-end">
            <button type="submit"
                    class="mt-4 px-4 py-2 h-10 bg-gray-200 hover:bg-indigo-700 hover:text-white border border-indigo-700 text-indigo-700 uppercase">
                <span>Submit</span>
            </button>
        </div>
    </form>
</div>
@endsection
