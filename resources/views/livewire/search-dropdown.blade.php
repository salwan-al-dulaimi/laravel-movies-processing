<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input wire:model.debounce.500ms="search" type="text"
        class="bg-gray-800 rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline"
        placeholder="Search"
        x-ref="search"
        @keydown.window="
            if (event.keyCode === 191) {
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        >

        <svg wire:loading class="top-0 right-0 mr-0 mt-0 animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>

    <div class="absolute top-0">
        <svg class="text-gray-400 h-4 w-4 fill-current mt-2 ml-2" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
            width="512px" height="512px">
            <path
                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
        </svg>
    </div>

    @if(strlen($search) > 2)
    <div class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4"
    x-show="isOpen"
    @keydown.escape.window="isOpen = false"
    
    >
        @if($searchResults->count() > 0)
            
        <ul>
            @foreach ($searchResults as $result)
            
                <li class="border-b border-gray-700">
                    <a href="{{ route('movies.show', $result['id']) }}" class="block hover:bg-gray-700 px-3 py-3">{{ $result['title'] }}
                        <img class="w-auto h-auto " src="{{ 'https://image.tmdb.org/t/p/w500/' . $result['backdrop_path'] }}" alt="">
                    </a>
                    
                    
                </li>
                
            @endforeach
        </ul>
        @else
            <div class="px-3 py-3">No results for "{{ $search }}"</div>
        @endif
        
    </div>
    @endif
    
</div>
