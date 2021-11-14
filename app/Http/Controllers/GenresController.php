<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GenresController extends Controller
{
    public function index()
    {
        $moviegenresArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        $tvgenresArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/tv/list')
            ->json()['genres'];

        return view('genres.index',['moviegenresArray' => $moviegenresArray, 'tvgenresArray' => $tvgenresArray]);
    }

    public function show($id)
    {
        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('http://api.themoviedb.org/3/discover/movie?with_genres='. $id )
            ->json()['results'];

            return view('genres.show', ['genres' => $genres]);
    }
}
