@extends('layouts.main')
@section('content')
    <div class="container mx-auto px-16 pt-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Popular Movies</h2>

            <div class="grid grid-cols-1 gap-8" id="moviesGenres">
                <ul class="genres">
                    @foreach ($genres as $key => $genre)
                        <li class="genre">
                            <a href="{{ route('genres.show', $key) }}" id="$key">{{$genre}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularMovies as $movie)
                    <x-movie-card :movie="$movie" :genres="$genres" />
                @endforeach
            </div>
        </div>
        <div class=" pt-16">
            <div class="popular-movies">
                <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">New playing</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($nowPlayingMovies as $movie)
                        <x-movie-card :movie="$movie"/>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
