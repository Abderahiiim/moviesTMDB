<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        
        $movies = Movie::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })->paginate(5);

        
        return view('admin.index', compact('movies'));
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.show', compact('movie'));
    }
    
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);

        return view('admin.edit', compact('movie'));
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'release_date' => 'required|date',
            'language' => 'required|string|max:50',
            'vote_average' => 'required|numeric|min:0|max:10',
            'vote_count' => 'required|integer|min:0',
            'popularity' => 'required|numeric|min:0',
        ]);

        // Find the movie by its ID
        $movie = Movie::findOrFail($id);

        // Update movie details
        $movie->title = $request->input('title');
        $movie->release_date = $request->input('release_date');
        $movie->language = $request->input('language');
        $movie->vote_average = $request->input('vote_average');
        $movie->vote_count = $request->input('vote_count');
        $movie->popularity = $request->input('popularity');

        // Save the updated movie details
        $movie->save();

        // Redirect back with a success message
        return redirect()->route('admin.index')->with('success', 'Movie updated successfully.');
    }
    
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect()->route('admin.index')->with('success', 'Movie deleted successfully');
    }
    
}
