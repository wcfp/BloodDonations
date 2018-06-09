<?php

namespace App\Http\Controllers;

use App\BloodContainer;
use App\BloodContainerType;
use App\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


    public function assignContainers(Request $request){
        if (!auth()->check()) {
            return response("", 401);
        }

        if (auth()->user()->role != UserType::ASSISTANT) {
            return response("", 403);
        }

        try{
            //TODO: check before assigning if the components are still good and not expired
            //TODO:  filter by blood type and rh too for every blood part and set status done for completed blood requests
            BloodContainer::where('type','=',BloodContainerType::PLASMA)
                ->whereNull('blood_request_id')
                ->orderBy('store_date','desc')
                ->take($request->blood_request["plasma_quantity"]-$request->blood_request["plasma_containers_count"])
                ->update(['blood_request_id'=>$request->blood_request['id']]);

            BloodContainer::where('type','=',BloodContainerType::THROMBOCYTE)
                ->whereNull('blood_request_id')
                ->orderBy('store_date','desc')
                ->take($request->blood_request[ 'thrombocyte_quantity']-$request->blood_request["thrombocyte_containers_count"])
                ->update(['blood_request_id'=>$request->blood_request['id']]);

            BloodContainer::where('type','=',BloodContainerType::RED_CELLS)
                ->whereNull('blood_request_id')
                ->orderBy('store_date','desc')
                ->take($request->blood_request['red_blood_cells_quantity']-$request->blood_request["red_cells_containers_count"])
                ->update(['blood_request_id'=>$request->blood_request['id']]);
        }
        catch (\Exception $exception){
            return response("$exception",500);
        }

        return response($request->blood_request,200);
    }
}
