<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TvController;

Auth::routes();

Route::get('/', [MoviesController::class, 'index']);
Route::resource('movie', MoviesController::class);

Route::get('/tv', [TvController::class, 'index'])->name('tv');
Route::get('/tv/{tv}', [TvController::class, 'show'])->name('tv.show');

Route::get('/topmovie', [MoviesController::class, 'topMovie'])->name('topmovie');
Route::get('/topmovie/page/{page?}', [MoviesController::class, 'topMovie']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/actors/{id}',[ActorController::class, 'show'])->name('actors.show');

Route::get('/search', function(){
  return view('search');
})->name('search');