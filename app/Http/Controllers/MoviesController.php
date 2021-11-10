<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Crew;
use App\Models\Image;
use App\Models\Movie;
use App\Models\Favorite;
use App\Models\CastMovie;
use App\Models\CrewMovie;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing')
            ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        $moviegenres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
            $genres,
        );

        return view('movie.index', $viewModel, ['moviegenres' => $moviegenres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user()->id;

        $userFavorite = Favorite::where('user_id', $user)->where('favorite_id', $id)->get()->count();

        $movie_db = Movie::where('id', $id)->with('casts', 'crews',)->first();

        if ($movie_db) {
            $movie_db = $movie_db->toArray() + ['credits' => ['casts' => []] + ['crews' => []]] + ['images' => ['backdrops' => []]];

            foreach ($movie_db['casts'] as $key => $cast) {
                $cast = Cast::where('id', $cast['cast_id'])->first();
                $cast = $cast->toArray();

                array_push($movie_db['credits']['casts'], $cast);
                if ($key == 4) {
                    break;
                }
            }

            foreach ($movie_db['crews'] as $key => $crew) {
                $crew = Crew::where('id', $crew['crew_id'])->first();
                $crew = $crew->toArray();

                array_push($movie_db['credits']['crews'], $crew);
                if ($key == 1) {
                    break;
                }
            }

            $images = Image::where('movie_id', $movie_db['id'])->take(9)->get();
            $images = $images->toArray();

            foreach ($images as $image) {

                array_push($movie_db['images']['backdrops'], $image);
            }
// dd($movie_db);
            $viewModel = new MovieViewModel($movie_db);
        } else {
            $movie_api = Http::withToken(config('services.tmdb.token'))
                ->get('http://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images')
                ->json();
            // dd($movie_api);
            $movie_db = new Movie;

            $movie_db->id = $movie_api['id'];
            $movie_db->adult = $movie_api['adult'];
            $movie_db->backdrop_path = $movie_api['backdrop_path'];
            $movie_db->budget = $movie_api['budget'];
            $movie_db['genres'] = json_encode($movie_api['genres']);
            $movie_db->homepage = $movie_api['homepage'];
            $movie_db->imdb_id = $movie_api['imdb_id'];
            $movie_db->original_language = $movie_api['original_language'];
            $movie_db->original_title = $movie_api['original_title'];
            $movie_db->overview = $movie_api['overview'];
            $movie_db->popularity = $movie_api['popularity'];
            $movie_db->poster_path = $movie_api['poster_path'];
            $movie_db['production_companies'] = json_encode($movie_api['production_companies']);
            $movie_db['production_countries'] = json_encode($movie_api['production_countries']);
            $movie_db->release_date = $movie_api['release_date'];
            $movie_db->revenue = $movie_api['revenue'];
            $movie_db->runtime = $movie_api['runtime'];
            $movie_db['spoken_languages'] = json_encode($movie_api['spoken_languages']);
            $movie_db->status = $movie_api['status'];
            $movie_db->tagline = $movie_api['tagline'];
            $movie_db->title = $movie_api['title'];
            $movie_db->video = $movie_api['video'];
            $movie_db->vote_average = $movie_api['vote_average'];
            $movie_db->vote_count = $movie_api['vote_count'];

            $movie_db->save();

            foreach ($movie_api['credits']['cast'] as $key => $cast_api) {
                $cast_db = new Cast;
                $cast_db->adult = $cast_api['adult'];
                $cast_db->gender = $cast_api['gender'];
                $cast_db->known_for_department = $cast_api['known_for_department'];
                $cast_db->name = $cast_api['name'];
                $cast_db->original_name = $cast_api['original_name'];
                $cast_db->popularity = $cast_api['popularity'];
                $cast_db->profile_path = $cast_api['profile_path'];
                $cast_db->cast_id = $cast_api['cast_id'];
                $cast_db->character = $cast_api['character'];
                $cast_db->credit_id = $cast_api['credit_id'];
                $cast_db->order = $cast_api['order'];
                $cast_db->save();

                $cast_movie_db = new CastMovie;
                $cast_movie_db->cast_id = $cast_db->id;
                $cast_movie_db->movie_id = $movie_db->id;
                $cast_movie_db->save();
            }

            foreach ($movie_api['credits']['crew'] as $key => $crew_api) {
                $crew_db = new Crew;

                $crew_db->adult = $crew_api['adult'];
                $crew_db->gender = $crew_api['gender'];
                $crew_db->known_for_department = $crew_api['known_for_department'];
                $crew_db->name = $crew_api['name'];
                $crew_db->original_name = $crew_api['original_name'];
                $crew_db->popularity = $crew_api['popularity'];
                $crew_db->profile_path = $crew_api['profile_path'];
                $crew_db->credit_id = $crew_api['credit_id'];
                $crew_db->department = $crew_api['department'];
                $crew_db->job = $crew_api['job'];
                $crew_db->save();

                $crew_movie_db = new CrewMovie;
                $crew_movie_db->crew_id = $crew_db->id;
                $crew_movie_db->movie_id = $movie_db->id;
                $crew_movie_db->save();
            }

            // images
            foreach ($movie_api['images']['backdrops'] as $key => $image_api) {
                // dd($image_api);
                $image_db = new Image;

                $image_db->movie_id = $movie_db->id;
                $image_db->aspect_ratio = $image_api['aspect_ratio'];
                $image_db->file_path = $image_api['file_path'];
                $image_db->height = $image_api['height'];
                $image_db->iso_639_1 = $image_api['iso_639_1'];
                $image_db->vote_average = $image_api['vote_average'];
                $image_db->vote_count = $image_api['vote_count'];
                $image_db->width = $image_api['width'];
                $image_db->save();
            }

            $viewModel = new MovieViewModel($movie_api);
        }
        // dd($viewModel);
        return view('movie.show', $viewModel)->with(['userFavorite' => $userFavorite]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
