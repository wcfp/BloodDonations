<?php

namespace App;

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

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
