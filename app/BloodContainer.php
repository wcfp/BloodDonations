<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BloodContainer extends Model
{
    const AVAILABILITY = [
        BloodContainerType::PLASMA => 365,
        BloodContainerType::RED_CELLS => 42,
        BloodContainerType::THROMBOCYTE => 5
    ];

    protected $fillable = [
        "type",
        "store_date",
        "blood_request_id",
        "donation_id",
    ];

    protected $appends = ['expiresIn', 'expired', "identifier"];

    public function bloodRequest()
    {
        return $this->belongsTo(BloodRequest::class);
    }

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    public function getExpiresInAttribute()
    {
        $storeDate = Carbon::parse($this->store_date);
        foreach (BloodContainer::AVAILABILITY as $type => $period) {
            if ($this->type == $type) {
                return $period - Carbon::now()->diffInDays($storeDate, true);
            }
        }
        return 0;
    }

    public function getExpiredAttribute()
    {
        return $this->expiresIn <= 0;
    }

    public function getIdentifierAttribute()
    {
        return $this->type[0] . (10000 + $this->id);
    }
}
