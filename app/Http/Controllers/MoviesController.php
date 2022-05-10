<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Crew;
use App\Models\Genre;
use App\Models\Image;
use App\Models\Movie;
use App\Models\Video;
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
        $popularMovies = cache()->remember('movies', 60*60*24, function () {
            return Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/movie/popular')
                ->json()['results'];
        });
        
        $nowPlayingMovies = cache()->remember('nowMovies', 60*60*24, function () {
            return Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing')
            ->json()['results'];
        });
           
        // If the genres not in the DB not use the cache and uncomment the if let it run 
        // to save all genres in the DDB from the API
        $genres = cache()->remember('genres', 30*60*60*24, function () {
            return Genre::all();
        });
        
        // $genres = Genre::all();

        // if ($genres->count() != 19) {
        //     $genres = Http::withToken(config('services.tmdb.token'))
        //         ->get('https://api.themoviedb.org/3/genre/movie/list')
        //         ->json()['genres'];

        //     foreach ($genres as $genre) {
        //         $genre_db = Genre::where('name', $genre['name'])->first();

        //         if ($genre_db->name != $genre['name']) {
        //             $genre_new = new Genre();
        //             $genre_new->id = $genre['id'];
        //             $genre_new->name = $genre['name'];
        //             $genre_new->save();
        //         }
        //     }
        // }
        
        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
            $genres,
        );

        return view('movie.index', $viewModel);
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
        
        $userFavorite = Favorite::where('user_id', $user)->where('favorite_id', $id)->select('id')->first();
        
        $movie_db = Movie::where('id', $id)->with('casts', 'crews')->first();

        if ($movie_db) {

            $movie_db = $movie_db->toArray() + ['credits' => ['cast' => []] + ['crew' => []]] + ['images' => ['backdrops' => []]] + ['videos' => ['results' => []]];

            foreach ($movie_db['casts'] as $key => $cast) {
                $cast = Cast::where('id', $cast['cast_id'])->first();
                $cast = $cast->toArray();

                array_push($movie_db['credits']['cast'], $cast);
                if ($key == 4) {
                    break;
                }
            }

            foreach ($movie_db['crews'] as $key => $crew) {
                $crew = Crew::where('id', $crew['crew_id'])->first();
                $crew = $crew->toArray();

                array_push($movie_db['credits']['crew'], $crew);
                if ($key == 1) {
                    break;
                }
            }

            $images = Image::where('related_id', $movie_db['id'])->where('type', 'movie')->take(9)->get();
            $images = $images->toArray();
            foreach ($images as $image) {
                array_push($movie_db['images']['backdrops'], $image);
            }

            $videos = Video::where('related_id', $movie_db['id'])->where('type', 'movie')->take(1)->get();
            $videos = $videos->toArray();
            foreach ($videos as $video) {
                array_push($movie_db['videos']['results'], $video);
            }

            $viewModel = new MovieViewModel($movie_db);

        } else {
            $movie_api = Http::withToken(config('services.tmdb.token'))
                ->get('http://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images')
                ->json();

            $movie_db = Movie::create([
                'id' => $movie_api['id'],
                'adult' => $movie_api['adult'],
                'backdrop_path' => $movie_api['backdrop_path'],
                'budget' => $movie_api['budget'],
                'genres' => json_encode($movie_api['genres']),
                'homepage' => $movie_api['homepage'],
                'imdb_id' => $movie_api['imdb_id'],
                'original_language' => $movie_api['original_language'],
                'original_title' => $movie_api['original_title'],
                'overview' => $movie_api['overview'],
                'popularity' => $movie_api['popularity'],
                'poster_path' => $movie_api['poster_path'],
                'production_companies' => json_encode($movie_api['production_companies']),
                'production_countries' => json_encode($movie_api['production_countries']),
                'release_date' => $movie_api['release_date'],
                'revenue' => $movie_api['revenue'],
                'runtime' => $movie_api['runtime'],
                'spoken_languages' => json_encode($movie_api['spoken_languages']),
                'status' => $movie_api['status'],
                'tagline' => $movie_api['tagline'],
                'title' => $movie_api['title'],
                'video' => $movie_api['video'],
                'vote_average' => $movie_api['vote_average'],
                'vote_count' => $movie_api['vote_count'],
            ]);

            // $movie_db->save();

            foreach ($movie_api['credits']['cast'] as $key => $cast_api) {
                $cast = Cast::where('id', $cast_api['id'])->first();

                if ($cast == null) {
                    $cast_db = Cast::create([
                        'id' => $cast_api['id'],
                        'adult' => $cast_api['adult'],
                        'gender' => $cast_api['gender'],
                        'known_for_department' => $cast_api['known_for_department'],
                        'name' => $cast_api['name'],
                        'original_name' => $cast_api['original_name'],
                        'popularity' => $cast_api['popularity'],
                        'profile_path' => $cast_api['profile_path'],
                        'cast_id' => $cast_api['cast_id'],
                        'character' => $cast_api['character'],
                        'credit_id' => $cast_api['credit_id'],
                        'order' => $cast_api['order'],
                    ]);

                    CastMovie::create([
                        'cast_id' => $cast_db->id,
                        'movie_id' => $movie_db->id
                    ]);

                    if ($key == 4) {
                        break;
                    }
                }
            }

            foreach ($movie_api['credits']['crew'] as $key => $crew_api) {
                $cast_db = Crew::where('id', $crew_api['id'])->first();

                if ($cast_db == null) {
                    $crew_db = new Crew;

                    $crew_db->id = $crew_api['id'];
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

                    if ($key == 1) {
                        break;
                    }
                }
            }

            // images
            foreach ($movie_api['images']['backdrops'] as $key => $image_api) {
                $image_db = new Image;

                $image_db->type = 'movie';
                $image_db->related_id = $movie_api['id'];
                $image_db->aspect_ratio = $image_api['aspect_ratio'];
                $image_db->file_path = $image_api['file_path'];
                $image_db->height = $image_api['height'];
                $image_db->iso_639_1 = $image_api['iso_639_1'];
                $image_db->vote_average = $image_api['vote_average'];
                $image_db->vote_count = $image_api['vote_count'];
                $image_db->width = $image_api['width'];
                $image_db->save();

                if ($key == 8) {
                    break;
                }
            }

            // videos
            foreach ($movie_api['videos']['results'] as $key => $video_api) {
                $video_db = new Video;

                $video_db->type = 'movie';
                $video_db->related_id = $movie_db->id;
                $video_db->iso_639_1 = $video_api['iso_639_1'];
                $video_db->iso_3166_1 = $video_api['iso_3166_1'];
                $video_db->name = $video_api['name'];
                $video_db->key = $video_api['key'];
                $video_db->site = $video_api['site'];
                $video_db->size = $video_api['size'];
                $video_db->official = $video_api['official'];
                $video_db->published_at = $video_api['published_at'];
                $video_db->save();

                if ($key == 0) {
                    break;
                }
            }

            $viewModel = new MovieViewModel($movie_api);
        }

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
