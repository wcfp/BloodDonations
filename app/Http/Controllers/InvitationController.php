<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Invitation;

class InvitationController extends Controller
{

    public function invite(InvitationRequest $request)
    {
        $invitation = Invitation::create($request->all());

        $this->dispatch(new InvitationJob());
    }
}
