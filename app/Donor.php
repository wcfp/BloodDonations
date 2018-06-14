<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{

    protected $fillable = [
        'blood_type',
        'rh',
        'phone_number',
        'weight',
        'birth_date',
        'user_id',
        'current_address_id',
        'residence_address_id',
        'cnp',
        'is_allowed',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCanDonateAttribute()
    {
        $lastDonation = $this->donations->max("appointment_date");
        if ($lastDonation === null) {
            return true;
        }
        return Carbon::parse($lastDonation)->addDays(90)->lessThanOrEqualTo(Carbon::today());
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function getDistanceAttribute() {
        return collect(str_split($this->cnp))->sum() / 10;
    }

}
