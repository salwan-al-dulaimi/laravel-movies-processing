<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\LanguagesViewModel;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Http::withToken(config('services.tmdb.token'))
        ->get('http://api.themoviedb.org/3/configuration/languages')
        ->json();

        return view('language.index', ['languages' => $languages]);
    }
    public function countries()
    {
        $countries = Http::withToken(config('services.tmdb.token'))
        ->get('http://api.themoviedb.org/3/configuration/countries')
        ->json();
        dd($countries);
        return view('language.index', ['languages' => $languages]);
    }

    public function show($id)
    {
        $languages = Http::withToken(config('services.tmdb.token'))
        ->get('http://api.themoviedb.org/3/discover/movie?with_original_language='. $id )
        ->json()['results'];

        // dd($languages);

        $genres = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/movie/list')
        ->json()['genres'];

        $viewModel = new LanguagesViewModel(
            $languages,
            $genres,
        );

        return view('language.show', $viewModel);
    }
}
