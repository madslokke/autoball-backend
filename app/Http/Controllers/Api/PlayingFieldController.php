<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlayingField;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlayingFieldController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $user = $request->user();

        return new Response(PlayingField::query()->where('company_id', '=', $user->company_id)->paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $companyId = $request->user()->company_id;

        $input = $request->all();
        $playingField = new PlayingField();
        $playingField->fill($input);
        $playingField->company_id = $companyId;
        $playingField->save();

        return new Response('success');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\PlayingField $playingField
     * @return \Illuminate\Http\Response
     */
    public function show(PlayingField $playingField) {
        return new Response($playingField);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PlayingField $playingField
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlayingField $playingField) {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $playingField->fill($request->all());
        $playingField->save();

        return new Response('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\PlayingField $playingField
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlayingField $playingField) {
        $playingField->delete();
        return new Response('success');
    }
}
