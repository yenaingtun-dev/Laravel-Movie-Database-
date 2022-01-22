<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\MoviesController;

Auth::routes();

Route::get('/', [MoviesController::class, 'index']);
Route::resource('movie', MoviesController::class);

Route::get('/topmovie', [MoviesController::class, 'topMovie'])->name('topmovie');
Route::get('/topmovie/page/{page?}', [MoviesController::class, 'topMovie']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/actors/{id}',[ActorController::class, 'show'])->name('actors.show');
//Route::get('/actors/{id}', 'ActorsController@show')->name('actors.show');
