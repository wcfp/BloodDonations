<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodContainer extends Model
{
    protected $fillable=[
        "type",
        "quantity",
        "store_date",
        "blood_request_id",
        "donation_id",
    ];

    public function bloodRequest(){
        return $this->belongsTo(BloodRequest::class);
    }

    public function donor(){
        return $this->belongsTo(Donor::class);
    }
}
