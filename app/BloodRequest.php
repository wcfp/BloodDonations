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
    protected $withCount = ["redCellsContainers", "plasmaContainers", "thrombocyteContainers"];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function bloodContainers()
    {
        return $this->hasMany(BloodContainer::class);
    }

    public function redCellsContainers()
    {
        return $this->hasMany(BloodContainer::class)->where('type', 'red_cells');
    }

    public function plasmaContainers()
    {
        return $this->hasMany(BloodContainer::class)->where('type', 'plasma');
    }

    public function thrombocyteContainers()
    {
        return $this->hasMany(BloodContainer::class)->where('type', 'thrombocyte');
    }

}
