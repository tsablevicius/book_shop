@extends('layouts.app')
@section('content')
    <div class="flex flex-col">
        <div class="flex flex-wrap">
            @each('books.card', $books, 'book')
        </div>

        <div class="py-4 px-4">
            {!! $books->links() !!}
        </div>

    </div>
@endsection
