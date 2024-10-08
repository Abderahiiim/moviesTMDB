<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
Route::resource('admin', adminController::class);
    
});


Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');


Route::get('/movies/search', [MovieController::class, 'search'])->name('movies.search');



Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');


