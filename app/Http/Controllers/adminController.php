<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(5); // Adjust pagination as needed
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
    
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect()->route('admin.index')->with('success', 'Movie deleted successfully');
    }
    
}
