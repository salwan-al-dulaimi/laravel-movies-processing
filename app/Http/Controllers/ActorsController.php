<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Social;
use Illuminate\Http\Request;
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
        // dd($id);

        $people = People::where('id', $id)->with('socials', 'combinedcredits')->first();

        if ($people) {
            dd('DB');
            // $actor = $people->toArray();
            $viewModel = new ActorViewModel($people, $people->socials, $people->combinedcredits);
        } else {
            // people
            $actor = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/' . $id)
            ->json();

            // dd($actor);
            $people = new People();

            $people->id = $actor['id'];
            $people->name = $actor['name'];
            $people->birthday = $actor['birthday'];
            $people->known_for_department = $actor['known_for_department'];
            $people->deathday = $actor['deathday'];
            $people['also_known_as'] = json_encode($actor['also_known_as']);
            $people->gender = $actor['gender'];
            $people->biography = $actor['biography'];
            $people->popularity = $actor['popularity'];
            $people->place_of_birth = $actor['place_of_birth'];
            $people->adult = $actor['adult'];
            $people->imdb_id = $actor['imdb_id'];
            $people->homepage = $actor['homepage'];

            $people->save();
            
            $social = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/' . $id . '/external_ids')
            ->json();
            
            $credits = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/' . $id . '/combined_credits')
            ->json();

            $viewModel = new ActorViewModel($actor, $social, $credits);
        }

        dd($viewModel);

        return view('actors.show', $viewModel);
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
