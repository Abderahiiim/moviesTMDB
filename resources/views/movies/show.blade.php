<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie->title }} - Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Avro:wght@700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css') 
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> 
    <style>
        .poster-container {
            position: relative;
            height: 200px;
        }
        .poster-container img {
            position: absolute;
            top: 200%;
            left: 30%;
            transform: translate(-50%, -50%);
            height: 200%; 
            width: auto;
        }
        body {
            background: rgb(0, 0, 0)    ;
        }
        .info{
            position: absolute;
            top: 200%;
            left: 40%;
        }
        h1{
            position: absolute;
            top: 120%;
            left: 40%;
        }
    </style>
</head>
<body>
    <div class="mx-auto">
        <header class="relative w-full h-96 border border-gray-500 bg-cover bg-center" style="background-image: url('https://image.tmdb.org/t/p/w500/{{ $movie->poster_path }}');">
            <div class="absolute inset-0 bg-black opacity-30 rounded-lg"></div>
            <div class="relative z-10">
                <h1 class="text-4xl font-bold text-white font-avro">{{ $movie->title }}</h1>

                <div class="poster-container">
                    <img class="border border-white" src="https://image.tmdb.org/t/p/w500/{{ $movie->poster_path }}" alt="{{ $movie->title }} Poster">
                </div>
                <div class="info w-1/2 h-96 text-white grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-2 p-5">
                    <div class="md:col-span-3 lg:col-span-3">
                        <p class="text-2xl font-bold text-white font-avro mb-6">Overview</p>
                        <p> {{ $movie->overview }}</p>
                    </div>
                    <div class="md:col-span-2 lg:col-span-2">
                        <p><strong>Release Date:</strong> {{ $movie->release_date }}</p>
                        <p><strong>Language:</strong> {{ $movie->language }}</p>
                        <p><strong>Rating:</strong> {{ round($movie->vote_average) }}/10</p>
                        <p><strong>Vote Count:</strong> {{ $movie->vote_count }}</p>
                        <p><strong>Popularity:</strong> {{ $movie->popularity }}</p>
                    </div>
                </div>
                
            </div>
        </header>
    </div>
</body>
</html>

