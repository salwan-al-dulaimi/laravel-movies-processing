@extends('layouts.main')
@section('content')
    <div class="container mx-auto px-16 pt-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Languages</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($languages as $key => $language)
                <a href="{{ route('language.show', $language['iso_639_1']) }}">
                <li class="genre">
                        {{$language['english_name']}}
                    </li>
                </a>
                @endforeach
            </div>
        </div>
    @endsection
