<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+CU:wght@100..400&display=swap" rel="stylesheet">
    <title>Movies List</title>
    
    @vite('resources/css/app.css') 
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> 
</head>
<style>
    .playwrite-cu {
        font-family: 'Playwrite CU', cursive;
        font-weight: 400; /* Adjust the weight if needed */
        font-style: normal;
        }

</style>

<body>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 playwrite-cu"><a href="{{ route('movies.index')}}">Movies List</a></h1>
        
        <!-- Search Form -->
        
        <form action="{{ route('movies.search') }}" method="GET" class="mb-4">
            <div class="flex flex-col md:flex-row items-end md:justify-end gap-4">
                <!-- Search Input -->
                <input
                    type="text"
                    name="query"
                    value="{{ request('query') }}"
                    placeholder="Search for a movie..."
                    class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                />
                
                <!-- Year Filter -->
                <select
                    name="year"
                    class="w-full md:w-40 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
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
                    class="w-full md:w-auto px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                    Search
                </button>
            </div>
        </form>
        


        <div class="mt-10 mb-5">
            {{ $movies->links() }}
        </div>

        @if($movies->isEmpty())
            <p class="text-center">No movies available.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($movies as $movie)
                    <a 
                        href="{{ route('movies.show', $movie->id) }}" 
                        class="bg-white shadow-md rounded-lg p-4 cursor-pointer"
                    >
                        <img src="https://image.tmdb.org/t/p/w500/{{ $movie->poster_path }}" alt="{{ $movie->title }} Poster" class="w-full h- object-cover rounded-lg mb-4">
                        <h2 class="text-xl font-semibold mb-2">{{ $movie->title }}</h2>
                    </a>
                @endforeach
            </div>

        @endif
    </div>
    
</body>
</html>
