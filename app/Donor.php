<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
