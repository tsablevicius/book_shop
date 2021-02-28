@extends('layouts.app')
@section('content')
    <section class="text-gray-600 body-font">
        <div class="px-5 py-6 flex">
            <div class="ml-4 w-1/3">
                <div class="flex flex-col justify-center">
                    <img src="{{asset('storage/cover_images/' . $book->cover_img_path)}}" alt="cover" />
                    @auth()
                        <div class="flex">
                            <a href="{{route('books.create-report', $book)}}"
                               class="mt-4 px-4 pt-3 h-10 bg-gray-200 hover:bg-indigo-700 hover:text-white border border-indigo-700 text-indigo-700 uppercase">
                                <span>Report</span>
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
            <div class="w-2/3 pl-10">
                <div class="flex justify-between">
                    <h2 class="text-2xl text-gray-900 font-medium title-font mb-2">
                        {{ $book->title }}
                    </h2>
                    <div>
                        <span class="mr-2">Rating:</span>
                        <rating :rating="{{ json_encode($book->book_rating) }}"/>
                    </div>
                </div>
                <hr>
                <p class="text-base text-gray-900 font-medium title-font my-2">
                    @foreach($book->authors as $author)
                        <span> {{$author->author}}</span>
                        @if(!$loop->last)
                            <span>, </span>
                        @endif()
                    @endforeach
                    <span>, {{ $book->year }}</span>
                </p>
                <p class="leading-relaxed text-base mt-2">
                    @foreach($book->genres as $genre)
                        <span> {{$genre->genre}}</span>
                        @if(!$loop->last)
                            <span>, </span>
                        @endif()
                    @endforeach
                </p>
                <p class="leading-relaxed text-base mt-8">
                    {{ $book->description }}
                </p>
                <review :id="{{ $book->id }}" :logged="{{Auth::check() ? 1 : 0}}"/>
            </div>
        </div>
    </section>
@endsection
