<?php

namespace App\Http\Controllers;

use App\Address;
use App\BloodRequest;
use App\Http\Requests\BloodFormRequest;
use App\UserType;


class BloodRequestController extends Controller
{
    public function createBloodRequest(BloodFormRequest $request)
    {
        if (!auth()->check()) {
            return response("", 401);
        }


        if (auth()->user()->role != UserType::DOCTOR) {
            return response("", 403);
        }

        $location = Address::create([
            'country' => $request->country,
            'city' => $request->city,
            'street' => $request->street,
            'number' => $request->number,
        ]);


        $blood_request = new BloodRequest;

        $blood_request->thrombocyte_quantity = $request->thrombocyte_quantity;
        $blood_request->plasma_quantity = $request->plasma_quantity;
        $blood_request->red_blood_cells_quantity = $request->red_blood_cells_quantity;
        $blood_request->blood_type = $request->blood_type;
        $blood_request->rh = $request->rh;
        $blood_request->urgency_level = $request->urgency_level;
        $blood_request->address = $location->id;
        $blood_request->doctor_id = auth()->id();

        $blood_request->save();

        return response()->json();
    }

    public function getAllBloodRequests()
    {
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }

        return BloodRequest::all();
    }
}
