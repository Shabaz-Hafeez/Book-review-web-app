@extends('layout.app')

@section('content')
    <h1 class="mb-4 text-2xl ">Add review for {{ $book->title }}</h1>

    <form action="{{ route('books.reviews.store', ['book' => $book->id]) }}" method="POST">
        @csrf

        <label for="review">Review</label>
        <textarea name="review" id="review" cols="30" rows="10" class="input mb-4" required></textarea>

        <label for="rating">Rating</label>
        <select name="rating" id="rating" class="input mb-4">
            <option value="">Select a review</option>
            @for ($i=1 ; $i<=5 ; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>

        <button type="submit" class="btn">Add Review</button>
    </form>
@endsection