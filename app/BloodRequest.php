<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{
    protected $fillable = [
        'thrombocyte_quantity',
        'plasma_quantity',
        'red_blood_cells_quantity',
        'blood_type',
        'rh',
        'urgency_level',
        'address',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

}
