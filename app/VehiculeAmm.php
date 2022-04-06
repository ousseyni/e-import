<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehiculeAmm extends Model
{
    protected $fillable = ['numlvi', 'numvehicule', 'numconteneur', 'idamm'];

    public function getAmm()
    {
        return $this->belongsTo(Amms::class, 'idamm');
    }
}
