@extends('layouts.main')
@section('content')
    <div class="container mx-auto px-16 pt-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Favorite Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                {{dd($movie['id'])}}
                @foreach ($movie as $key=>$movieFavorite)
                    <div class="mt-8">
                    <a href="{{ route('movies.show', $movie[$key]['id']) }}">
                        <img src="{{ $movie[$key]['poster_path'] }}" alt="parasite"
                            class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('movies.show', $movie[$key]['id']) }}"
                            class="text-lg mt-2 hover:text-gray-300">{{ $movie[$key]['title'] }}</a>
                        <div class="flex items-center text-gray-400">
                            <span><i class="fas fa-star fill-current text-yellow-500 w-4"></i></span>
                            <span class="ml-1">{{ $movie[$key]['vote_average']}}</span>
                            <span class="mx-2">|</span>
                            <span>{{ $movie[$key]['release_date'] }}</span>
                        </div>
                        <div class="text-gray-400">{{ $movie[$key]['genres'] }}</div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    @endsection
