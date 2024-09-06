<?php

namespace App\Http\Controllers;

use App\Models\Movie; 
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function fetchandStore()
    {
      
        $apiKey = env('TMDB_API_KEY');


        if (!$apiKey) {
            return response()->json(['message' => 'API Key not set. Please check your .env file.'], 400);
        }

    
        $response = Http::get('https://api.themoviedb.org/3/trending/movie/day', [
            'api_key' => $apiKey,
        ]);

      
        


        $movies = $response->json()['results'] ?? [];

        foreach ($movies as $movie) {
     
            $title = $movie['title'];
            $overview = $movie['overview'];
            $releaseDate = $movie['release_date'] ?? null;
            $language = $movie['original_language'];
            $posterPath = $movie['poster_path'];
            $voteAverage = $movie['vote_average'];
            $voteCount = $movie['vote_count'];
            $popularity = $movie['popularity'];

            Movie::updateOrCreate(
                ['title' => $title], # unique 
                [
                    'overview' => $overview,
                    'release_date' => $releaseDate,
                    'language' => $language,
                    'poster_path' => $posterPath,
                    'vote_average' => $voteAverage,
                    'vote_count' => $voteCount,
                    'popularity' => $popularity,
                ]
            );
        }

        return response()->json(['message' => 'Data fetched and stored successfully!']);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
