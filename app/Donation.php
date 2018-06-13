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

    protected $appends = ["identifier"];

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function getIdentifierAttribute()
    {
        return "D" . $this->donor->user->name[0] . $this->donor->user->surname[0] . (10000 + $this->id);
    }
}