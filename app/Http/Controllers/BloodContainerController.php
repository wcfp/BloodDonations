<?php

namespace App\Http\Controllers;

use App\BloodContainer;
use App\UserType;
use Illuminate\Http\Request;

class BloodContainerController extends Controller
{
    public function getAllBloodContainers(){
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }

        return BloodContainer::with("donation.donor")->get();
    }
}
