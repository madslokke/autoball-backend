<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlayerController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($teamId) {
        return new Response(PlayerResource::collection(Player::query()
            ->where('team_id', '=', $teamId)
            ->get()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $teamId) {

        $this->validate($request, [
            'name' => 'required',
            'weapon_id' => 'required',
            'product_id' => 'required'
        ]);

        $input = $request->all();
        $player = new Player();
        $player->fill($input);
        $player->team_id = $teamId;
        $player->save();

        return new Response('success');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Player $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player) {
        return new Response($player);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Player $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player) {
        $this->validate($request, [
            'name' => 'required',
            'weapon_id' => 'required',
            'product_id' => 'required'
        ]);

        $player->fill($request->all());
        $player->save();

        return new Response('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Player $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player) {
        $player->delete();
        return new Response('success');
    }


    public function setAsPaid(Request $request, $teamId, $playerId) {
        $player = Player::query()->where('id', '=', $playerId)->firstOrFail();
        $player->is_paid = true;
        $player->save();
        $team = $player->team;
        $players = $team->players->get();

        $notPaidPlayers = array_filter($players, function ($p) {
            return $p->is_paid;
        });

        if (empty($notPaidPlayers)) {
            $team->status = 4;
            $team->save();
        }

        return new Response('success');
    }


}
