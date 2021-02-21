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
                        @include('components.rating', ['rating' => $book->book_rating])
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
                <div class="md:mt-4 mt-6">
                    <h2 class="text-2xl text-gray-900 font-medium title-font mb-2">Reviews</h2>
                    @foreach($book->reviews as $review)
                        <div class="border-2 my-2">
                            <div class="flex justify-between px-2 py-2">
                                <div class="text-base text-gray-900 font-medium title-font">
                                    <span>{{$review->author_name}}</span>
                                </div>
                                @if($review->rating)
                                    <div>
                                        @include('components.rating', ['rating' => $review->rating])
                                    </div>
                                @endif
                            </div>

                            <div class="px-2 py-2">
                                {{$review->comment}}
                            </div>
                        </div>
                    @endforeach
                </div>
                @auth()
                    <div class="w-full md:mt-4 mt-6">
                        <h2 class="text-lg text-gray-900 font-medium title-font mt-4">Add review</h2>
                        @include('components.review', ['book' => $book])
                    </div>
                @endauth
            </div>
        </div>
    </section>
@endsection
