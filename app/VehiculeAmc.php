<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehiculeAmc extends Model
{
    protected $fillable = ['numlvi', 'numvehicule', 'numconteneur', 'idamc'];

    public function getAmc()
    {
        return $this->belongsTo(Amcs::class, 'idamc');
    }
}
