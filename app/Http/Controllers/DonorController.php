<?php

namespace App\Http\Controllers;

use App\Address;
use App\Donor;
use App\Http\Requests\CreateDonorProfileRequest;
use App\UserType;

class DonorController extends Controller
{

    public function store(CreateDonorProfileRequest $request)
    {
        $residence_address = Address::create([
            'country' => $request->residence_country,
            'city' => $request->residence_city,
            'street' => $request->residence_street,
            'number' => $request->residence_number,
        ]);

        if ($request->has($request->current_address)) {
            $current_address = Address::create([
                'country' => $request->current_country,
                'city' => $request->current_city,
                'street' => $request->current_street,
                'number' => $request->current_number,
            ]);
        }


        Donor::create([
            'blood_type' => $request->blood_type,
            'rh' => $request->rh,
            'phone_number' => $request->phone_number,
            'weight' => $request->weight,
            'birth_date' => $request->birth_date,
            'user_id' => auth()->id(),
            'current_address' => $residence_address->id,
            'residence_address' => isset($current_address) ? $current_address->id : null
        ]);
    }


    public function update(CreateDonorProfileRequest $request, Donor $donor)
    {
//        $is_allowed = auth()->user()->role == UserType::ASSISTANT ?
    }
}
