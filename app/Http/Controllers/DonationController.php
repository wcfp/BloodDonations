<?php

namespace App\Http\Controllers;

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
        $this->donorAuth();
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

        $donation = new Donation;

        $donation->status = DonationStatus::REQUESTED;
        $donation->status_date = Carbon::now();
        $donation->appointment_date = $date;
        $donation->donor_id = Donor::where('user_id', auth()->id())->firstOrFail()->id;

        $donation->save();

        return response()->json();
    }

    public function donorAuth()
    {
        if (!auth()->check()) {
            return response("", 401);
        }


        if (auth()->user()->role != UserType::DONOR) {
            return response("", 403);
        }
    }

    public function returnHistory(Request $request)
    {
        $this->donorAuth();

        return Donor::where('user_id', auth()->id())->firstOrFail()->donations;
    }

    public function getAllAppointments(Request $request)
    {
        $this->assistantAuth();

        return Donation::where("status", DonationStatus::REQUESTED)->get();
    }

    public function assistantAuth()
    {
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }
    }

    public function moveToCollected(Donation $donation)
    {
        $this->assistantAuth();

        $donation->update(["status" => DonationStatus::COLLECTED]);
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
  
    public function moveToAnalyzed(Donation $donation)
    {
        $this->assistantAuth();

        $donation->update(["status" => DonationStatus::ANALYZED]);
    }

    public function moveToStored(Donation $donation)
    {
        $this->assistantAuth();

        $donation->update(["status" => DonationStatus::STORED]);
        //TODO move to 3 containers
    }

    public function rejectionReason(Donation $donation)
    {
        $this->assistantAuth();
        $donation->update(["status" => DonationStatus::REJECTED]);
        $donation->donor()->update(["is_allowed" => "false"]);
    }

    public function updateDonation(Donation $donation, Request $request)
    {
        DB::beginTransaction();

        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }
        $donation->update([
            $donation->pulse = $request->pulse,
            $donation->blood_pressure_systolic = $request->blood_pressure_systolic,
            $donation->blood_pressure_diastolic = $request->blood_pressure_diastolic,
            $donation->consumed_fat = $request->consumed_fat,
            $donation->consumed_alcohol = $request->consumed_alcohol,
            $donation->has_smoked = $request->has_smoked,
            $donation->sleep_quality = $request->sleep_quality
        ]);

        DB::commit();
    }
}
