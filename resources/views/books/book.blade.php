@extends('layouts.app')
@section('content')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-6 flex">
            <div class="ml-4 w-1/3">
                <div class="flex justify-center">
                    <img  class="w-4/5" src="{{ $book->cover_img_path }}" alt="book_cover">
                </div>
            </div>
            <div class="w-2/3">
                <h2 class="text-2xl text-gray-900 font-medium title-font mb-2">
                    {{ $book->title }}
                </h2>
                <hr>
                <p class="text-base text-gray-900 font-medium title-font my-2">
                    {{ $book->author }}, {{ $book->year }}
                </p>
                <p class="leading-relaxed text-base mt-2">
                    {{ $book->genre }}
                </p>
                <p class="leading-relaxed text-base mt-8">
                    {{ $book->description }}
                </p>
                <div class="flex md:mt-4 mt-6">

                </div>
            </div>
        </div>
    </section>
@endsection
