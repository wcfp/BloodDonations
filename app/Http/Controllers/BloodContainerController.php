<?php

namespace App\Http\Controllers;

use App\BloodContainer;
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
            DB::table('blood_containers')
            ->update(['blood_request_id'=>$request->blood_request['id']])
            ->where('type','=','plasma')
            ->orderBy('store_date','desc')
            ->take($request->blood_request["plasma_quantity"]-$request->blood_request["plasma_containers_count"]);
        }
        catch (\Exception $exception){
            return response("$exception",200);
        }

//        DB::table('blood_containers')
//            ->where('type','=','thrombocyte')
//            ->orderBy('store_date','desc')
//            ->take($bloodRequest->thrombocyte_quantity - $bloodRequest.thrombocyte_count)
//            ->update(['blood_request_id',$bloodRequest.id]);
//        DB::table('blood_containers')
//            ->where('type','=','red cells')
//            ->orderBy('store_date','desc')
//            ->take($bloodRequest->red_cells_quantity-$bloodRequest.red_cells_count)
//            ->update(['blood_request_id',$bloodRequest.id]);

        return response('hurra',200);
    }
}
