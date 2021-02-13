@extends('layouts.app')
@section('content')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-6 flex">
            <div class="ml-4 w-1/3">
                <div class="flex justify-center">
                    <img src="{{asset('storage/cover_images/' . $book->cover_img_path)}}" alt="cover" />
                </div>
            </div>
            <div class="w-2/3 pl-10">
                <h2 class="text-2xl text-gray-900 font-medium title-font mb-2">
                    {{ $book->title }}
                </h2>
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
                <div class="flex md:mt-4 mt-6">

                </div>
            </div>
        </div>
    </section>
@endsection
