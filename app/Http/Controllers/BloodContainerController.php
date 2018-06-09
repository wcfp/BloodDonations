<?php

namespace App\Http\Controllers;

use App\BloodContainer;
use App\BloodContainerType;
use App\BloodRequest;
use App\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

        return BloodContainer::with("donation.donor")->get();
    }


    public function assignContainers(BloodRequest $bloodRequest, Request $request)
    {
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }

        try {
            //TODO:  filter by blood type and rh too for every blood part and set status done for completed blood requests
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
                ->where('rh', $bloodRequest->rh)
                ->where("blood_type", $bloodRequest->blood_type)
                ->whereDate("store_date", '>', Carbon::now()->subDays(42))
                ->orderBy('store_date', 'asc')
                ->take($bloodRequest->red_blood_cells_quantity - $bloodRequest->redCellsContainers()->count())
                ->update(['blood_request_id' => $bloodRequest->id]);

        } catch (\Exception $exception) {
            return response("$exception", 500);
        }

        return response($request->blood_request, 200);
    }
}
