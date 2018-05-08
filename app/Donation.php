<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'pulse',
        'blood_pressure_systolic',
        'blood_pressure_diastolic',
        'consumed_fat',
        'consumed_alcohol',
        'has_smoked',
        'sleep_quality',
        'status',
        'status_date',
        'rejection_reason'
    ];


    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

}