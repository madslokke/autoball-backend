<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use App\Models\Player;
use App\Models\Product;
use App\Models\Weapon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeamCodeController extends Controller {
    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function showTeamByTeamCode(Request $request, $teamCode) {
        $team = Product::query()->where('team_code', '=', $teamCode)->first();
        return new Response(new TeamResource($team));
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function showWeaponsByTeamCode(Request $request, $teamCode) {
        $team =
            Product::query()->where('team_code', '=', $teamCode)->firstOrFail();
        $companyId = $team->company_id;
        $weapons =
            Weapon::query()
                ->where('company_id', '=', $companyId)
                ->whereHas('players', function ($query) {
                    $query->whereHas('team', function ($query) {
                        $query->where('active', '=', 1);
                    });
                }, '=', 0)
                ->get();
        return new Response($weapons);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function showProductsByTeamCode(Request $request, $teamCode) {
        $team =
            Product::query()->where('team_code', '=', $teamCode)->firstOrFail();
        $companyId = $team->company_id;
        $products =
            Product::query()->where('company_id', '=', $companyId)->get();
        return new Response($products);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function createPlayer(Request $request, $teamCode) {

        $this->validate($request, [
            'name' => 'required',
            'weapon_id' => 'required',
            'product_id' => 'required'
        ]);

        $team =
            Product::query()->where('team_code', '=', $teamCode)->firstOrFail();

        $input = $request->all();
        $player = new Player();
        $player->fill($input);
        $player->team_id = $team->id;
        $player->save();

        return new Response('success');

        $products =
            Product::query()->where('company_id', '=', $companyId)->get();
        return new Response($products);
    }


}
