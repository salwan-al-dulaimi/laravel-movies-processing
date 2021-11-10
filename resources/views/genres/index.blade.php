@extends('layouts.main')
@section('content')
    <div class="container mx-auto px-16 pt-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Genres Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                <ul>
                        @foreach ($moviegenresArray as $index=>$item)
                            <a href="{{ route('genres.show', $moviegenresArray[$index]["id"]) }}" id="{{$moviegenresArray[$index]["id"]}}">{{$moviegenresArray[$index]["name"]}}</a>
                            <br>
                        @endforeach
                </ul>
            </div>
        </div>
        <div class=" pt-16">
            <div class="popular-movies">
                <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Genres SHOWS</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    {{-- @foreach ($tvgenresArray as $movie) --}}
                        {{-- {{$tvGenres}} <br> --}}
                        {{-- <x-movie-card :movie="$movie"/> --}}
                    {{-- @endforeach --}}
                </div>
            </div>
        </div>
    @endsection