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
        
        <!-- Search Form -->
        <form action="{{ route('movies.search') }}" method="GET" class="mb-4">
            <div class="flex flex-col md:flex-row items-center gap-4">
                <!-- Search Input -->
                <input
                    type="text"
                    name="query"
                    value="{{ request('query') }}"
                    placeholder="Search for a movie..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                />
                
                <!-- Year Filter -->
                <select
                    name="year"
                    class="mt-2 md:mt-0 w-full md:w-40 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                    <option value="">All Years</option>
                    @for ($year = 2000; $year <= date('Y'); $year++)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
                
                <button
                    type="submit"
                    class="mt-2 md:mt-0 px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                    Search
                </button>
            </div>
        </form>

        @if($movies->isEmpty())
            <p class="text-center">No movies available.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($movies as $movie)
                    <a 
                        href="{{ route('movies.show', $movie->id) }}" 
                        class="bg-white shadow-md rounded-lg p-4 cursor-pointer"
                    >
                        <img src="https://image.tmdb.org/t/p/w500/{{ $movie->poster_path }}" alt="{{ $movie->title }} Poster" class="w-full h-64 object-cover rounded-lg mb-4">
                        <h2 class="text-xl font-semibold mb-2">{{ $movie->title }}</h2>
                        <p class="text-gray-700 mb-2">{{ $movie->overview }}</p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
