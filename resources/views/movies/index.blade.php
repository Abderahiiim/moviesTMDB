
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>
    
    @vite('resources/css/app.css') 
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> 
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Movies List</h1>

        @if($movies->isEmpty())
            <p class="text-center">No movies available.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($movies as $movie)
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <img src="https://image.tmdb.org/t/p/w500/{{ $movie->poster_path }}" alt="{{ $movie->title }} Poster" class="w-full h-64 object-cover rounded-lg mb-4">
                        <h2 class="text-xl font-semibold mb-2">{{ $movie->title }}</h2>
                        <p class="text-gray-700 mb-2">{{ $movie->overview }}</p>
                        <p class="text-gray-500">Release Date: {{ $movie->release_date }}</p>
                        <p class="text-gray-500">Language: {{ $movie->language }}</p>
                        <p class="text-gray-500">Popularity: {{ number_format($movie->popularity, 2) }}</p>
                        <p class="text-gray-500">Vote Average: {{ number_format($movie->vote_average, 1) }} ({{ $movie->vote_count }} votes)</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
