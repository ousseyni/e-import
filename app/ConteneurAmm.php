<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConteneurAmm extends Model
{
    protected $fillable = ['nomnavire', 'numvoyage', 'numbietc', 'numconnaissement', 'numconteneur', 'idamm'];

    public function getAmm()
    {
        return $this->belongsTo(Amms::class, 'idamm');
    }
}
