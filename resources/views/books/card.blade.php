<div class="relative px-2 py-8 w-1/5">
    @if ($book->new_book)
        <div class="absolute top-10 right-1 bg-indigo-600 text-white rounded-full h-6 px-3 py-1 uppercase">
            New
        </div>
    @endif

    @if ($book->discount)
        <div class="absolute {{$book->new_book ? 'top-20' : 'top-10'}} right-1 bg-red-600 text-white rounded-full h-10 px-1 py-3 uppercase">
            -{{ $book->discount }}%
        </div>
    @endif

    <div class="bg-white shadow-2xl" >
        <div>
            <img src="{{asset('storage/cover_images/' . $book->cover_img_path)}}" alt="cover" />
        </div>
        <div class="px-4 py-2 mt-2 bg-white">
            <h2 class="font-bold text-2xl text-gray-800">{{ $book->title }}</h2>
            <p class="text text-gray-700 my-3">
                @foreach($book->authors as $author)
                    <span> {{$author->author}}</span>
                    @if(!$loop->last)
                        <span>, </span>
                    @endif()
                @endforeach
                <span> {{$book->year}}</span>
            </p>
            @if($book->discount)
                <p class="text-lg mr-1 my-3">
                    <span class="text-red-600">{{$book->price_with_discount}} &euro;</span>
                    <span class="line-through ml-4 text-gray-400">{{$book->price}} &euro;</span>
                </p>
            @else
                <p class="text-lg ttext-gray-800 mr-1 my-3">
                    <span>{{$book->price}} &euro;</span>
                </p>
            @endif
            <div class="flex justify-end mb-4">
                <a href="{{route('books.show', $book)}}" class="text-gray-500">More</a>
            </div>
        </div>
    </div>
</div>
