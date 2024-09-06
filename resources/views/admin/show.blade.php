@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-20">
    <div class="flex  items-center gap-8">
        <!-- First div with the movie poster -->
        <div class="w-1/3">
            <img src="https://image.tmdb.org/t/p/w500/{{ $movie->poster_path }}" alt="{{ $movie->title }} Poster" class="w-full h- object-cover rounded-lg mb-4">
        </div>

        <!-- Second div with movie information -->
        <div class="w-2/3">
            <h1 class="text-2xl font-bold mb-4">{{ $movie->title }}</h1>
            <p><strong>Overview:</strong> {{ $movie->overview }}</p>
            <p><strong>Release Date:</strong> {{ $movie->release_date }}</p>
            <p><strong>Language:</strong> {{ $movie->language }}</p>
            <p><strong>Vote Average:</strong> {{ $movie->vote_average }}</p>
            <p><strong>Vote Count:</strong> {{ $movie->vote_count }}</p>
            <p><strong>Popularity:</strong> {{ $movie->popularity }}</p>

            <a href="{{ route('admin.index') }}" class="text-blue-500 mt-4 inline-block">Back to List</a>
        </div>
    </div>
</div>
@endsection
