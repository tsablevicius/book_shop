@extends('layouts.profile')
@section('content')
    <div class="antialiased sans-serif bg-gray-200 h-full">
        <div class="container mx-auto py-2 px-4">
            <div class="flex justify-between">
                <h1 class="text-3xl py-4 border-b">My books</h1>
                <a href="{{route('books.create')}}" class="h-10 bg-gray-200 hover:bg-indigo-700 hover:text-white border border-indigo-700 text-indigo-700 pt-2.5 px-6 mr-8 rounded-md">
                    <span class="mt-2">Add book</span>
                </a>
            </div>
            <div class="overflow-y-auto relative"
                 style="height: 100vh;">
                <div class="flex flex-col">
                    <div class="py-2 overflow-x-auto sm:px-6">
                        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                            <table class="min-w-full">
                                <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Author
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Genre
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Confirmed
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                                </tr>
                                </thead>
                                <tbody class="bg-white">
                                @foreach($books as $book)
                                    <tr>
                                        <td class="px-6 py-4 border-b border-gray-200">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-12 w-10">
                                                    <img class="h-12 w-10" src="{{asset('storage/cover_images/' . $book->cover_img_path)}}" alt="cover" />
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm leading-5 font-medium text-gray-900">{{$book->title}}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-900">
                                                @foreach($book->authors as $author)
                                                    <span> {{$author->author}}</span>
                                                    @if(!$loop->last)
                                                        <span>, </span>
                                                    @endif()
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-900">
                                                @foreach($book->genres as $genre)
                                                    <span> {{$genre->genre}}</span>
                                                    @if(!$loop->last)
                                                        <span>, </span>
                                                    @endif()
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                            <div class="text-sm leading-5 text-gray-900">{{$book->price}}</div>
                                        </td>
                                        <td class="pl-6 pr-2 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                            <div class="text-sm leading-5 text-gray-900 ml-4">
                                                @if ($book->is_confirmed)
                                                    <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @else
                                                    <svg class="h-5 w- text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="flex-nowrap pr-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                            <a href="{{ route('books.show', $book) }}" class="text-gray-600 hover:text-gray-900 focus:outline-none focus:underline">Show</a>
                                            <a href="{{ route('books.edit', $book) }}" class="ml-4 text-indigo-600 hover:text-indigo-900 focus:outline-none focus:underline">Edit</a>
                                            <div class="flex justify-end">
                                                @if(auth()->user()->isAdmin())
                                                    <form action="{{route('books.confirm', ['id' => $book->id])}}" method="POST" class="flex-nowrap">
                                                        @csrf
                                                        <button type="submit" class="ml-4 text-blue-600 hover:text-blue-900 focus:outline-none focus:underline">Confirm</button>
                                                    </form>
                                                @endif
                                                <form action="{{route('books.destroy', $book)}}" method="POST" class="flex-nowrap">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ml-4 text-red-600 hover:text-red-900 focus:outline-none focus:underline">Delete</button>
                                                </form>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
