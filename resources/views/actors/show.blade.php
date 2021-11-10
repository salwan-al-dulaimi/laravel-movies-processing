@extends('layouts.main')

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{ $actor['profile_path'] }}" alt="poster" class="w-64 lg:w-96">
                <ul class="flex items center mt-4">
                    @if($social['facebook'])
                    <a href="{{ $social['facebook'] }}" title="Facebook"  target="_blank"><i class="fab fa-facebook-square fa-2x mr-2  text-gray-400"></i></a>
                    @endif
                    @if($social['instagram'])
                    <a href="{{ $social['instagram'] }}" title="Instagram"  target="_blank"><i class="fab fa-instagram-square fa-2x mr-2 text-gray-400"></i></a>
                    @endif
                    @if($social['twitter'])
                    <a href="{{ $social['twitter'] }}" title="Twitter"  target="_blank"><i class="fab fa-twitter-square fa-2x mr-2 text-gray-400"></i></a>
                    @endif
                    @if($actor['homepage'])
                    <a href="{{ $actor['homepage'] }}" title="Website"  target="_blank"><i class="fas fa-globe fa-2x mr-2 text-gray-400"></i></a>
                    @endif
                </ul>
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{ $actor['name'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                    <i class="fas fa-birthday-cake"></i><span class="ml-1">{{ $actor['birthday'] }}</span>
                    
                    <span class="mx-2">({{ $actor['age'] }} Years old)</span>
                    <span class="mx-2">|</span>
                    <span class="mx-2"><i class="fas fa-map-marker-alt mr-1"></i>{{ $actor['place_of_birth'] }}</span>
                </div>

                <p class="text-gray-300 mt-8">{{ $actor['biography'] }}</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
                    @foreach($knownForMovies as $movie)
                    <div class="mt-4">
                        <a href="{{ $movie['linkToPage'] }}"><img src="{{ $movie['poster_path'] }}" alt="poster" class="hover:opacity-75 transition ease-in-out duration-150"></a>
                            <a href="{{ $movie['linkToPage'] }}" class="text-sm leading-normal block text-gray-400 hover:text-white mt-1">{{ $movie['title'] }}</a>
                    </div>
                        
                    @endforeach
                </div>

            </div>
        </div>
    </div> <!-- end credits-info -->

    <div class="credits border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Credits</h2>

            <ul class="list-disc leading-loose pl-5 mt-8">
                @foreach($credits as $credit)
                    <li>{{ $credit['release_year'] }}  &middot; <strong>{{ $credit['title'] }}</strong> as {{ $credit['character'] }}</li>
                @endforeach

            </ul>
            
        </div>
    </div> <!-- end credits -->
@endsection