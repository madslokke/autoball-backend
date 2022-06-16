<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReloadStationResource;
use App\Models\Product;
use App\Models\ReloadStation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReloadStationController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $user = $request->user();

        return new Response(ReloadStationResource::collection(ReloadStation::query()->where('company_id', '=', $user->company_id)->get()));
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
            'bullets' => 'required',
            'playing_field_id' => 'required'
        ]);
        $companyId = $request->user()->company_id;

        $input = $request->all();
        $reloadStation = new ReloadStation();
        $reloadStation->fill($input);
        $reloadStation->company_id = $companyId;
        $reloadStation->save();

        return new Response('success');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ReloadStation $reloadStation
     * @return \Illuminate\Http\Response
     */
    public function show(ReloadStation $reloadStation) {
        return new Response(new ReloadStationResource($reloadStation));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ReloadStation $reloadStation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReloadStation $reloadStation) {
        $this->validate($request, [
            'name' => 'required',
            'bullets' => 'required',
            'playing_field_id' => 'required'
        ]);

        $reloadStation->fill($request->all());
        $reloadStation->save();

        return new Response('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ReloadStation $reloadStation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReloadStation $reloadStation) {
        $reloadStation->delete();
        return new Response('success');
    }
}
