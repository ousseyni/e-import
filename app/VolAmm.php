<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VolAmm extends Model
{
    protected $fillable = ['numlta', 'cieaerien', 'numvol', 'idamm'];

    public function getAmm()
    {
        return $this->belongsTo(Amms::class, 'idamm');
    }
}
