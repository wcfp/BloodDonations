<?php

namespace App\Http\Controllers;

use App\Address;
use App\BloodRequest;
use App\BloodRequestStatus;
use App\Donor;
use App\Http\Requests\BloodFormRequest;
use App\UserType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BloodRequestController extends Controller
{
    public function createBloodRequest(BloodFormRequest $request)
    {
        DB::beginTransaction();
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

        $blood_request = new BloodRequest();
        $cnp = $request->cnp;
        $blood_request->urgency_level = $request->urgency_level ?: 'low';
        if ($cnp != null && Donor::where('cnp', $cnp)->exists()) {
            $blood_request->urgency_level = 'high';
        }

        $blood_request->thrombocyte_quantity = $request->thrombocyte_quantity ?: 0;
        $blood_request->plasma_quantity = $request->plasma_quantity ?: 0;
        $blood_request->red_blood_cells_quantity = $request->red_blood_cells_quantity ?: 0;
        $blood_request->blood_type = $request->blood_type;
        $blood_request->rh = $request->rh;
        $blood_request->address_id = $location->id;
        $blood_request->doctor_id = auth()->id();
        $blood_request->status = BloodRequestStatus::REQUESTED;
        $blood_request->status_date = Carbon::now()->toDateTimeString();
        $blood_request->save();

        DB::commit();
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

    public function getMyBloodRequests()
    {
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::DOCTOR) {
            return response("", 403);
        }

        return BloodRequest::where('doctor_id', auth()->id())->where('status', BloodRequestStatus::REQUESTED)->get();
    }

    public function getBloodRequestDoctor(BloodRequest $bloodRequest)
    {
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::DOCTOR) {
            return response("", 403);
        }

        return $bloodRequest;
    }

    public function getBloodRequestAssistant(BloodRequest $bloodRequest)
    {
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }

        return $bloodRequest;
    }

    public function changeBloodRequestStatus(BloodRequest $bloodRequest, Request $request)
    {
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }

        //TODO add the status from BloodRequestStatus
        $bloodRequest->status = $request->status;
        $bloodRequest->save();
        return response()->json();
    }

    public function returnHistory(Request $request)
    {
        if (!auth()->check()) {
            return response("", 401);
        }


        if (auth()->user()->role != UserType::DOCTOR) {
            return response("", 403);
        }

        return BloodRequest::where("doctor_id", auth()->id())->where('status', BloodRequestStatus::DONE)->get();
    }
}
