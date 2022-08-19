<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    return new Response(Role::query()->get());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Models\User $user
   * @return \Illuminate\Http\Response
   */
  public function show(Role $role) {
    return new Response($role);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Models\User $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user) {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\User $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user) {
    //
  }
}
