<?php

namespace App\Http\Controllers;

use App\BloodContainer;
use App\BloodContainerType;
use App\BloodRequest;
use App\BloodRequestStatus;
use App\UserType;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BloodContainerController extends Controller
{
    public function getAllBloodContainers()
    {
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }

        return BloodContainer::with("donation.donor")->orderBy("store_date")->get()->sortByDesc(function ($container) {
            if ($container->blood_request_id !== null) {
                return 0;
            } else if ($container->expired) {
                return 1;
            }
            return 2;
        })->values();
    }


    public function assignContainers(BloodRequest $bloodRequest)
    {
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }
        DB::beginTransaction();
        BloodContainer::where('type', '=', BloodContainerType::PLASMA)
            ->whereNull('blood_request_id')
            ->whereDate("store_date", '>', Carbon::now()->subYear())
            ->orderBy('store_date', 'asc')
            ->take($bloodRequest->plasma_quantity - $bloodRequest->plasmaContainers()->count())
            ->update(['blood_request_id' => $bloodRequest->id]);

        BloodContainer::where('type', '=', BloodContainerType::THROMBOCYTE)
            ->whereNull('blood_request_id')
            ->whereDate("store_date", '>', Carbon::now()->subDays(5))
            ->orderBy('store_date', 'asc')
            ->take($bloodRequest->thrombocyte_quantity - $bloodRequest->thrombocyteContainers()->count())
            ->update(['blood_request_id' => $bloodRequest->id]);

        BloodContainer::where('type', '=', BloodContainerType::RED_CELLS)
            ->whereNull('blood_request_id')
            ->whereHas('donation.donor', function ($query) use ($bloodRequest) {
                if ($bloodRequest->rh === "-") {
                    $query = $query->where("rh", "=", "-");
                }
                $allowedBloodTypes = ["0"];
                if (starts_with($bloodRequest->blood_type, "A")) {
                    $allowedBloodTypes[] = "A";
                }

                if (ends_with($bloodRequest->blood_type, "B")) {
                    $allowedBloodTypes[] = "B";
                }

                if ($bloodRequest->blood_type === "AB") {
                    $allowedBloodTypes[] = "AB";
                }
                return $query->whereIn("blood_type", $allowedBloodTypes);
            })
            ->whereDate("store_date", '>', Carbon::now()->subDays(42))
            ->orderBy('store_date', 'asc')
            ->take($bloodRequest->red_blood_cells_quantity - $bloodRequest->redCellsContainers()->count())
            ->update(['blood_request_id' => $bloodRequest->id]);
        DB::commit();

        $bloodRequest = $bloodRequest->refresh();
        if ($bloodRequest->isDone) {
            $bloodRequest->update([
                "status" => BloodRequestStatus::DONE,
                "status_date" => Carbon::now()->toDateTimeString()
            ]);
        }

        return $bloodRequest;
    }
}
