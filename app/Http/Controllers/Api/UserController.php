<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller {

    public function me(Request $request) {
        return new Response(new UserResource($request->user()));
    }

}
