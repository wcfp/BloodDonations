<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Invitation;
use App\Jobs\InvitationJob;
use Illuminate\Http\Request;

class InvitationController extends Controller
{

    public function invite(InvitationRequest $request)
    {
        $token = str_random();
        $role = $request->role;
        $email = $request->email;

        $invitation = Invitation::create(compact('token', 'email', 'role'));

        $this->dispatch(new InvitationJob($invitation));
    }

    public function invitation(Request $request)
    {
        return Invitation::where('token', $request->token)->firstOrFail();
    }
}
