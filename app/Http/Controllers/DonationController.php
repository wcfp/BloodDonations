<?php

namespace App\Http\Controllers;

use App\BloodRequest;
use App\Donation;
use App\DonationStatus;
use App\Donor;
use App\UserType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DonationController extends Controller
{

    public function createAppointment(Request $request)
    {
        if (!auth()->check()) {
            return response("", 401);
        }


        if (auth()->user()->role != UserType::DONOR) {
            return response("", 403);
        }

        $date = Carbon::createFromFormat('Y-m-d H:i:s', $request->date);

        if ($date->lessThan(Carbon::today())) {
            return response()->json(['message' => "You can't make an appointment for the past"], 400);
        }

        // TODO validate if eligible for donation

        $donation = new Donation;

        $donation->status = DonationStatus::REQUESTED;
        $donation->status_date = Carbon::now();
        $donation->appointment_date = $date;
        $donation->donor_id = Donor::where('user_id', auth()->id())->firstOrFail()->id;

        $donation->save();

        return response()->json();
    }

    public function returnHistory(Request $request)
    {
        if (!auth()->check()) {
            return response("", 401);
        }


        if (auth()->user()->role != UserType::DONOR) {
            return response("", 403);
        }

        return Donor::where('user_id', auth()->id())->firstOrFail()->donations;
    }

    public function getAllAppointments(Request $request)
    {
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }

        return Donation::where("status", DonationStatus::REQUESTED)->get();
    }


}
