<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class LanguagesViewModel extends ViewModel
{
    public $languages;
    public $genres;


    public function __construct($languages, $genres)
    {
        $this->languages = $languages;
        $this->genres = $genres;

    }
    

    public function languages()
    {
        return $this->formatMovies($this->languages);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }
    private function formatMovies($movies)
    {
        return collect($movies)->SortByDesc('vote_average')->map(function($language) {
            $genresFormatted = collect($language['genre_ids'])->mapWithKeys(function($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            
            return collect($language)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$language['poster_path'],
                'vote_average' => $language['vote_average'] * 10 .'%',
                'release_date' => $language['release_date'] ,
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres',
            ]);
        });
    }



}
