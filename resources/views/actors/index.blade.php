@extends('layouts.main')
@section('content')
    <div class="container mx-auto px-16 py-16">
        <div class="popular-actors">
            <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Popular Actors</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($popularActors as $actor)
                <div class="actor mt-8">
                    <a href="{{ route('actors.show', $actor['id']) }}">
                        <img src="{{ $actor['profile_path'] }}" alt="profile image"
                            class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('actors.show', $actor['id']) }}" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                        <div class="text-sm truncate text-gray-400">{{ $actor['known_for'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="page-load-status my-8">
            <div class="flex justify-center">
                <svg class="top-0 right-0 mr-0 mt-0 animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">Error</p>
          </div>

    @endsection
@section('scripts')
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
<script>

    var elem = document.querySelector('.grid');
    var infScroll = new InfiniteScroll( elem, {
    // options
    path: '/actors/page/@{{#}}',
    append: '.actor',
    status: '.page-load-status',
    // history: false,
    });

</script>
@endsection