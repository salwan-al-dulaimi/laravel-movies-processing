@extends('layouts.main')
@section('content')
    <div class="container mx-auto px-16 pt-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Popular Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($genres as $movie)
                <div class="mt-8">
                    <a href="{{ route('movies.show', $movie['id']) }}">
                        <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] }}" alt="parasite"
                            class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('movies.show', $movie['id']) }}"
                            class="text-lg mt-2 hover:text-gray-300">{{ $movie['title'] }}</a>
                        <div class="flex items-center text-gray-400">
                            <span><i class="fas fa-star fill-current text-yellow-500 w-4"></i></span>
                            <span class="ml-1">{{ $movie['vote_average']}}</span>
                            <span class="mx-2">|</span>
                            @isset ($movie['release_date'])
                                <span>{{ $movie['release_date'] }}</span>
                            @endisset                          
                        </div>
                        {{-- <div class="text-gray-400">{{ $movie['genres'] }}</div> --}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class=" pt-16">
            <div class="popular-movies">
                <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">New playing</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    {{-- @foreach ($nowPlayingMovies as $movie)
                        <x-movie-card :movie="$movie"/>
                    @endforeach --}}
                </div>
            </div>
        </div>
    @endsection
