<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Weapon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WeaponController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $user = $request->user();

        return new Response(Weapon::query()->where('company_id', '=', $user->company_id)->paginate(25));
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
            'nfc_id' => 'required'
        ]);
        $companyId = $request->user()->company_id;

        $input = $request->all();
        $weapon = new Weapon();
        $weapon->fill($input);
        $weapon->company_id = $companyId;
        $weapon->save();

        return new Response('success');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Weapon $weapon
     * @return \Illuminate\Http\Response
     */
    public function show(Weapon $weapon) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Weapon $weapon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Weapon $weapon) {
        $this->validate($request, [
            'name' => 'required',
            'nfc_id' => 'required'
        ]);

        $weapon->fill($request->all());
        $weapon->save();

        return new Response('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Weapon $weapon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weapon $weapon) {
        $weapon->delete();
    }
}
