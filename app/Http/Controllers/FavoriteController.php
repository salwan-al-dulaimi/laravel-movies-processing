<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class FavoriteController extends Controller
{
    public function create($id){
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

    public function show(){
        $user = Auth::user()->id;
        $userFavorite = Favorite::where('user_id', $user)->pluck('favorite_id');
        dd($userFavorite[]);
        foreach ($userFavorite as $uf){ 
            $movie = Http::withToken(config('services.tmdb.token'))
            ->get('http://api.themoviedb.org/3/movie/' . $uf . '?append_to_response=credits,videos,images')
            ->json();
        }
        dd($movie);
        return view('favorite.index', $movie);
    }

    public function destroy($id){
        $user = Auth::user()->id;
        Favorite::where('user_id', $user)->where('favorite_id', $id)->delete();
        return redirect()->back();
    }
}
