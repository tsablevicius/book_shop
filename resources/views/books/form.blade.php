@extends('layouts.profile')
@section('content')
    <div class="w-2/3 mx-auto mt-4 mb-8">
        @if(isset($book))
            <form action="{{route('books.update', $book)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form action="{{route('books.store')}}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf
            <input id="title" type="text"
                   class="mt-4 form-input w-full border border-gray-500 @error('title') border-red-500 @enderror"
                   name="title"
                   value="{{ isset($book) ? $book->title : old('title') }}"
                   required
                   placeholder="Title">
            @error('title')
            <p class="text-red-500 text-xs italic mt-2">
                {{ $message }}
            </p>
            @enderror

            <input id="author" type="text"
                   class="mt-4 form-input w-full border border-gray-500 @error('author') border-red-500 @enderror"
                   name="author"
                   value="{{ isset($book) ? $book->author : old('author') }}"
                   required
                   placeholder="Author">
            <p class="ml-4 text-gray-500 text-xs mt-1">
                Multiple authors separate by coma
            </p>
            @error('author')
            <p class="text-red-500 text-xs italic mt-2">
                {{ $message }}
            </p>
            @enderror

            <input id="genre" type="text"
                   class="mt-4 form-input w-full border border-gray-500 @error('genre') border-red-500 @enderror"
                   name="genre"
                   value="{{ isset($book) ? $book->genre : old('genre') }}"
                   required
                   placeholder="Genre">
            <p class="ml-4 text-gray-500 text-xs mt-1">
                Multiple genres separate by coma
            </p>
            @error('genre')
            <p class="text-red-500 text-xs italic mt-2">
                {{ $message }}
            </p>
            @enderror

            <input id="year" type="number"
                   class="mt-4 form-input w-full border border-gray-500 @error('year') border-red-500 @enderror"
                   name="year"
                   value="{{ isset($book) ? $book->year : old('year') }}"
                   required
                   placeholder="Year">
            @error('year')
            <p class="text-red-500 text-xs italic mt-2 mb-6">
                {{ $message }}
            </p>
            @enderror

            <input id="price" type="number"
                   class="mt-4 form-input w-full border border-gray-500 @error('price') border-red-500 @enderror"
                   name="price"
                   value="{{ isset($book) ? $book->price : old('price') }}"
                   required
                   placeholder="Price">
            @error('price')
            <p class="text-red-500 text-xs italic mt-2">
                {{ $message }}
            </p>
            @enderror

            <input id="discount" type="number"
                   class="mt-4 form-input w-full border border-gray-500 @error('discount') border-red-500 @enderror"
                   name="discount"
                   value="{{ isset($book) ? $book->discount : old('discount') }}"
                   placeholder="Discount">
            @error('discount')
            <p class="text-red-500 text-xs italic mt-2">
                {{ $message }}
            </p>
            @enderror


            <input id="description" type="text"
                   class="h-40 mt-4 form-input w-full border border-gray-500 @error('description') border-red-500 @enderror"
                   name="description"
                   value="{{ isset($book) ? $book->description : old('description') }}"
                   placeholder="Description">
            @error('description')
            <p class="text-red-500 text-xs italic mt-2">
                {{ $message }}
            </p>
            @enderror

            <input id="cover" type="file"
                   class="mt-4 form-input w-full border border-gray-500 @error('cover') border-red-500 @enderror"
                   name="cover_img_path"
                   value="{{ isset($book) ? $book->cover_img_path : old('cover_img_path') }}"
                   placeholder="Cover">
            @error('cover')
            <p class="text-red-500 text-xs italic mt-2">
                {{ $message }}
            </p>
            @enderror

            <button type="submit"
                    class="mt-4 w-full h-10 bg-gray-200 hover:bg-indigo-700 hover:text-white border border-indigo-700 text-indigo-700 uppercase">
                <span>Submit</span>
            </button>
        </form>
    </div>
@endsection
