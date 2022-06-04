<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller {

    public function createTeam(Request $request) {

        $team = new Team();
        $team->fill($request->all());
        $user = $request->user();

        if (!$user) {
            return;
        }


        $team->team_code = random_int(0, 999999);
        $team->company_id = $user->company_id;
        $team->save();
    }

}
