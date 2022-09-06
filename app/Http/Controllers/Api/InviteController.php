<?php

namespace App\Http\Controllers\Api;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\InviteResource;
use App\Models\Invite;
use App\Models\User;
use App\Notifications\InviteNotification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InviteController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $user = $request->user();
        return new Response(InviteResource::collection(Invite::query()
            ->where('company_id', '=', $user->company_id)
            ->get()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required'
        ]);
        $validator->after(function ($validator) use ($request) {
            if (Invite::where('email', $request->input('email'))->exists()) {
                $validator->errors()->add('email', 'There exists an invite with this email!');
            }
        });

        if ($validator->fails()) {
            return new Response('There exists an invite with this email');
        }
        do {
            $token = Str::random(20);
        } while (Invite::where('token', $token)->first());

        Invite::create([
            'token' => $token,
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id'),
            'company_id' => $user->company_id,

        ]);
        $url = 'https://app.autoball.dk/admin/register?token=' . $token;

        Notification::route('mail', $request->input('email'))->notify(new InviteNotification($url));

        return new Response('success');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Invite $invite
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) {
        $invite = new InviteResource(Invite::query()->where('token', '=', $request->token)->first());
        return new Response($invite);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Invite $invite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invite $invite) {
        return new Response('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Invite $invite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invite $invite) {
        $invite->delete();
        return new Response('success');
    }

    public function createUser(Request $request) {
        $invite = Invite::query()->where('token', '=', $request->token)->first();
        $createUser = new CreateNewUser();
        $createUser->create([
            'name' => $request->get('name'),
            'email' => $invite->email,
            'password' => $request->get('password'),
            'company_id' => $invite->company_id,
            'role_id' => $invite->role_id
        ]);

        $this->destroy($invite);
        return new Response('Success');
    }
}
