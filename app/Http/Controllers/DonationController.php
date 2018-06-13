<?php

namespace App\Http\Controllers;

use App\BloodContainer;
use App\BloodContainerType;
use App\Donation;
use App\DonationStatus;
use App\Donor;
use App\Mail\RejectionMail;
use App\UserType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


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
            return response()->json(['errors' => ["You can't make an appointment for the past"]], 400);
        }

        $donor = Donor::where('user_id', auth()->id())->firstOrFail();

        if (!$donor->is_allowed) {
            return response()->json(['errors' => ["You are not allowed to donate"]], 400);
        }

        $latestDonationDate = Donation::where('donor_id', $donor->id)->select('appointment_date')->max('appointment_date');
        if ($latestDonationDate) {
            $latestDonationDate = Carbon::createFromFormat('Y-m-d H:i:s', $latestDonationDate)->addDays(90);

            if ($date->lessThan($latestDonationDate)) {
                return response()->json(['errors' => ["There must be a 90 day delay between two donations"]], 400);
            }
        }

        $donation = new Donation();

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

    public function moveToCollected(Donation $donation, Request $request)
    {
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }

        $donation->donor()->update(['rh' => $request->rh, 'blood_type' => $request->blood_type]);
        $donation->update([
            "status" => DonationStatus::COLLECTED,
            "status_date" => Carbon::now()
        ]);
    }


    public function getAllDonations(Request $request)
    {
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }

        return Donation::with("donor.user")->get();
    }

    public function moveToAnalyzed(Donation $donation, Request $request)
    {
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }

        $donation->update([
            "status" => DonationStatus::ANALYZED,
            "status_date" => Carbon::now()
        ]);

        $donation->donor()->update([
            "rh" => $request->rh,
            "blood_type" => $request->blood_type
        ]);
    }

    public function moveToStored(Donation $donation)
    {
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }
        DB::beginTransaction();
        $donation->update([
            "status" => DonationStatus::STORED,
            "status_date" => Carbon::now(),
        ]);
        $bloodContainer = new BloodContainer();
        $bloodContainer->store_date = Carbon::now();
        $bloodContainer->donation_id = $donation->id;
        $bloodContainer->type = BloodContainerType::THROMBOCYTE;
        $bloodContainer->quantity = 1;
        $bloodContainer->save;

        $bloodContainer = new BloodContainer();
        $bloodContainer->store_date = Carbon::now();
        $bloodContainer->donation_id = $donation->id;
        $bloodContainer->type = BloodContainerType::PLASMA;
        $bloodContainer->quantity = 1;
        $bloodContainer->save();

        $bloodContainer = new BloodContainer();
        $bloodContainer->store_date = Carbon::now();
        $bloodContainer->donation_id = $donation->id;
        $bloodContainer->type = BloodContainerType::RED_CELLS;
        $bloodContainer->quantity = 1;
        $bloodContainer->save();
        DB::commit();
    }

    public function rejectionReason(Donation $donation, Request $request)
    {
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }
        $donation->update([
            "status" => DonationStatus::REJECTED,
            "rejection_reason" => $request->reason,
            "status_date" => Carbon::now()
        ]);
        $donation->donor()->update(["is_allowed" => false]);
        $this->sendRejectionMail($donation);

    }


    public function sendRejectionMail(Donation $donation)
    {
        Mail::to($donation->donor()->user->email)->send(new RejectionMail($donation));
    }

    public function moveToRegistered(Donation $donation, Request $request)
    {
        DB::beginTransaction();

        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }
        $donation->update([
            "pulse" => $request->pulse,
            "blood_pressure_systolic" => $request->blood_pressure_systolic,
            "blood_pressure_diastolic" => $request->blood_pressure_diastolic,
            "consumed_fat" => $request->consumed_fat,
            "consumed_alcohol" => $request->consumed_alcohol,
            "has_smoked" => $request->has_smoked,
            "sleep_quality" => $request->sleep_quality,
            "status" => DonationStatus::REGISTERED,
            "status_date" => Carbon::now(),

        ]);

        DB::commit();
    }
}
