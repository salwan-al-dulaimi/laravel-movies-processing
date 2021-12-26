<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) > 1) {
            $searchResults = Http::withToken(config('services.tmdb.token'))
    ->get('http://api.themoviedb.org/3/search/movie?query=' . $this->search)
    ->json()['results'];
        }

        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->take(10),
        ]);
    }
}
