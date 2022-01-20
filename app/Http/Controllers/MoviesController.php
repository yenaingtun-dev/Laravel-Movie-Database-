<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{

    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];
        $genereArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        //dd($popularMovies);
        //dd($genereArray);

        $genres = collect($genereArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
        return view('index', compact('popularMovies', 'genres'));
    }


    public function topMovie()
    {
        $topMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/top_rated')
            ->json()['results'];
        //dd($topMovies);
        $genereArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        //dd($popularMovies);
        //dd($genereArray);

        $genres = collect($genereArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
        return view('movies/index', compact('topMovies', 'genres'));
    }

    public function show($movie)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/' . $movie . '?append_to_response=credits,videos,images')
            ->json();
        //dd($movie);     
        $genereArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        //dump($movie);
        //dd($genereArray);

        $genres = collect($genereArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
        return view('movies.show', compact('movie', 'genres'));
    }

}
