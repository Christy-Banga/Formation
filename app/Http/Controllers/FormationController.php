<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Inertia\Inertia;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formations = Formation::with('user')
        ->select('formations.*', DB::raw(
            '(SELECT COUNT(DISTINCT(user_id))
            FROM completions
            INNER JOIN episodes ON completions.episode_id = episodes.id
            WHERE episodes.formation_id = formations.id
            ) AS participants'

        ))
        ->withCount('episodes')->latest()->paginate(4);

        return Inertia::render('Formations/index',[
            'formations' => $formations
        ]);
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
        $formation = Formation::create(
            $request->validate([
                'title' => ['required', 'max:50'],
                'description' => ['required', 'max:50'],
            ])
        );

        foreach($request->input('episodes') as $episode)
        {
            $episode['formation_id'] = $formation->id;
            Episode::create($episode);
        }

        return Redirect::route('formations.index')->with('success','Félicitation, la formation
         a bien été mise en ligne.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $formation = Formation::where('id',$id)->with('episodes')->first();
        $watched = auth()->user()->episodes;

        return Inertia::render('Formations/show',[
            'formation' => $formation,
            'watched' => $watched
        ]);
    }

    public function toggleProgress(Request $request)
    {
        $id = $request->input('episodeId');
        $user = auth()->user();

        $user->episodes()->toggle($id);

        return $user->episodes;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $formation = Formation::where('id',$id)->with('episodes')->first();
        $this->authorize('update',$formation);

        return Inertia::render('Formations/edit',[
            'formation' => $formation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $formation = Formation::where('id',$request->id)->with('episodes')->first();
        $this->authorize('update',$formation);


        $formation->update($request->all());
        $formation->episodes()->delete();

        foreach($request->episodes as $episode){
            $episode['formation_id'] = $formation->id;
            Episode::create($episode);
        }

        return Redirect::route('formations.index')->with('warning','Félicitation, la formation
         a bien été modifié.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formation $formation)
    {
        //
    }
}
