<?php

namespace App\Http\Controllers;

use App\Address;
use App\Donor;
use App\Http\Requests\CreateDonorProfileRequest;
use App\Mail\CallForDonationMail;
use App\UserType;
use Grpc\Call;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DonorController extends Controller
{

    public function store(CreateDonorProfileRequest $request)
    {
        DB::beginTransaction();
        $current_address = Address::create([
            'country' => $request->current_country,
            'city' => $request->current_city,
            'street' => $request->current_street,
            'number' => $request->current_number,
        ]);

        if ($request->input('residence_address', false)) {
            $residence_address = Address::create([
                'country' => $request->residence_country,
                'city' => $request->residence_city,
                'street' => $request->residence_street,
                'number' => $request->residence_number,

            ]);
        }


        Donor::create([
            'blood_type' => $request->blood_type,
            'rh' => $request->rh,
            'phone_number' => $request->phone_number,
            'weight' => $request->weight,
            'birth_date' => $request->birth_date,
            'user_id' => auth()->id(),
            'current_address_id' => $current_address->id,
            'residence_address_id' => isset($residence_address) ? $residence_address->id : null,
            'cnp' => $request->cnp
        ]);

        DB::commit();
    }


    public function updateDonorProfileInfo(Donor $donor, Request $request)
    {
        DB::beginTransaction();

        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }

        $donor->update([
            "rh" => $request->rh,
            "blood_type" => $request->blood_type,
            "is_allowed" => $request->is_allowed
        ]);

        DB::commit();
    }

    public function getProfileInfo()
    {
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::DONOR) {
            return response("", 403);
        }

        return Donor::where('user_id', auth()->id())->firstOrFail();
    }

    public function getAllDonors()
    {
        return Donor::with(['user', 'donations' => function ($query) {
            return $query->select('appointment_date');
        }])->withCount("donations")
            ->get()
            ->each(function ($donor) {
                $donor->append(['canDonate', 'distance']);
            })
            ->sortByDesc("canDonate")
            ->sortByDesc("isAllowed")->values();
    }

    public function callForDonation(Donor $donor)
    {
        Mail::send("callForDonationMail", [], function (Message $mail) use($donor) {
            $mail->from('donations@codespace.ro');
            $mail->sender('donations@codespace.ro');
            $mail->to($donor->user->email);
            $mail->subject('We miss you');
        });
    }
}
