<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Social;
use Illuminate\Http\Request;
use App\Models\CombinedCredits;
use App\ViewModels\ActorViewModel;
use App\ViewModels\ActorsViewModel;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
        abort_if($page > 500, 204);
        $popularActors = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/popular?page=' . $page)
            ->json()['results'];

        $viewModel = new ActorsViewModel($popularActors, $page);
        return view('actors.index', $viewModel);
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
        $people = People::where('id', $id)->with('socials', 'combinedcredits')->first();

        if ($people != null) {

            $actor = $people->toArray();
            $social = null;
            $credits = null;

            $credits = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/person/' . $id . '/combined_credits')
                ->json();

            $viewModel = new ActorViewModel($actor, $social, $credits);
        } else {
            // people
            $actor = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/person/' . $id)
                ->json();

            $people = People::create([
                'id' => $actor['id'],
                'name' => $actor['name'],
                'birthday' => $actor['birthday'],
                'known_for_department' => $actor['known_for_department'],
                'deathday' => $actor['deathday'],
                'also_known_as' => json_encode($actor['also_known_as']),
                'gender' => $actor['gender'],
                'biography' => $actor['biography'],
                'popularity' => $actor['popularity'],
                'place_of_birth' => $actor['place_of_birth'],
                'profile_path' => $actor['profile_path'],
                'adult' => $actor['adult'],
                'imdb_id' => $actor['imdb_id'],
                'homepage' => $actor['homepage'],
            ]);

            $social = Social::where('id', $id)->first();

            $social = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/person/' . $id . '/external_ids')
                ->json();

            Social::create([
                'id' => $id,
                'people_id' => optional($actor['id']),
                'imdb_id' => optional($social['imdb_id']),
                'facebook_id' => optional($social['facebook_id']),
                'freebase_mid' => optional($social['freebase_mid']),
                'freebase_id' => optional($social['freebase_id']),
                'tvrage_id' => optional($social['tvrage_id']),
                'twitter_id' => optional($social['twitter_id']),
                'instagram_id' => optional($social['instagram_id']),
            ]);

            $credits = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/person/' . $id . '/combined_credits')
                ->json();

            $newCredits = new CombinedCredits();

            $newCredits->id = $id;
            $newCreditsCast = [];
            $newCreditsCrew = [];

            foreach ($credits['cast'] as $cast) {
                array_push($newCreditsCast, $cast['id']);
            }

            foreach ($credits['crew'] as $crew) {
                array_push($newCreditsCrew, $crew['id']);
            }
            $newCredits['cast'] = json_encode($newCreditsCast);
            $newCredits['crew'] = json_encode($newCreditsCrew);

            $newCredits->save();

            $viewModel = new ActorViewModel($actor, $social, $credits);

            return view('actors.show', $viewModel);
        }
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
