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
        "status",
        "status_date"
    ];
    protected $withCount = ["redCellsContainers", "plasmaContainers", "thrombocyteContainers"];

    protected $appends = ["isDone", "identifier"];

    protected $eagerLoad = ["redCellsContainers", "plasmaContainers", "thrombocyteContainers"];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function getIsDoneAttribute()
    {
        return $this->thrombocyteContainers->count() == $this->thrombocyte_quantity &&
            $this->redCellsContainers->count() == $this->red_blood_cells_quantity &&
            $this->plasmaContainers->count() == $this->plasma_quantity;
    }

    public function thrombocyteContainers()
    {
        return $this->containers()->where('type', BloodContainerType::THROMBOCYTE);
    }

    public function containers()
    {
        return $this->hasMany(BloodContainer::class);
    }

    public function redCellsContainers()
    {
        return $this->containers()->where('type', BloodContainerType::RED_CELLS);
    }

    public function plasmaContainers()
    {
        return $this->containers()->where('type', BloodContainerType::PLASMA);
    }

    public function getIdentifierAttribute()
    {
        return "R" . $this->doctor->name[0] . $this->doctor->surname[0] . (10000 + $this->id);
    }
}
