<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Movie;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class FavoriteController extends Controller
{
    public function create($id)
    {
        $user = Auth::user()->id;

        $userFavorite = Favorite::where('user_id', $user)->where('favorite_id', $id)->get();

        if (count($userFavorite) == 0) {
            $data = Favorite::create([
                'favorite_id'   => $id,
                'user_id'       => $user,
            ]);
            $data->save();
        }
        return redirect()->back();
    }

    public function show()
    {
        $user = Auth::user()->id;
        $userFavorite = Favorite::where('user_id', $user)->pluck('favorite_id');

        $favorites = [];
        foreach ($userFavorite as $key => $uf) {

            $movie = Movie::where('id', $uf)->with('casts', 'crews')->first()->toArray() + ['genres_array' => []];

            $genres = json_decode($movie['genres']);

            array_push($favorites, $movie);

            foreach ($genres as $genre) {
                array_push($favorites[$key]['genres_array'], $genre);
            }

        }

        return view('favorite.index', ['favorites' => $favorites]);
    }

    public function destroy($id)
    {
        $user = Auth::user()->id;
        Favorite::where('user_id', $user)->where('favorite_id', $id)->delete();
        return redirect()->back();
    }
}
