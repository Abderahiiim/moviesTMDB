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





     public function index()
     {
         if (Movie::count() === 0) {
             $this->fetchAndStore();
         }
     
         // Paginate the movies, 5 per page
         $movies = Movie::paginate(4);
     
         return view('movies.index', compact('movies'));
     }
     
    public function fetchAndStore()
    {
        $apiKey = env('TMDB_API_KEY');

        if (!$apiKey) {
            return response()->json(['message' => 'API Key not set. Please check your .env file.'], 400);
        }

        $response = Http::get('https://api.themoviedb.org/3', [
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
                ['title' => $title], // unique
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
    
    }

    
    public function show($id)
    {
        $movie = Movie::findOrFail($id); 

        return view('movies.show', compact('movie'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $year = $request->input('year');

        $movies = Movie::query()
            ->when($query, function ($queryBuilder, $query) {
                return $queryBuilder->where('title', 'like', "%{$query}%");
            })
            ->when($year, function ($queryBuilder, $year) {
                return $queryBuilder->whereYear('release_date', $year);
            })
            ->paginate(4);

        return view('movies.index', compact('movies'));
    }


}
