<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeamController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $user = $request->user();

        return new Response(TeamResource::collection(Team::query()->where('company_id', '=', $user->company_id)->get()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'start_date' => 'required',
            'playing_field_id' => 'required'
        ]);
        $companyId = $request->user()->company_id;

        $input = $request->all();
        $team = new Team();
        $team->fill($input);
        $team->company_id = $companyId;
        $team->team_code = random_int(0, 999999);
        $team->save();

        return new Response('success');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team) {
        return new Response(new TeamResource($team));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team) {
        $this->validate($request, [
            'name' => 'required',
            'start_date' => 'required',
            'playing_field' => 'required'
        ]);

        $team->fill($request->all());
        $team->save();

        return new Response('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team) {
        $team->delete();
        return new Response('success');
    }
}
