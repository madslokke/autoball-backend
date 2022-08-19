<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invite;
use App\Notifications\InviteNotification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InviteController extends Controller {

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function invite(Request $request) {

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
        $url = 'autoball.dk/admin/register?token=' . $token;

        Notification::route('mail', $request->input('email'))->notify(new InviteNotification($url));

        return new Response('success');
    }

}
