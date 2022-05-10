<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LigneInspectionConteneurAmm extends Model
{
    protected $fillable = ['conteneurinspecte', 'numeroplomb', 'idinspectionamm'];

    public function getInspectionAmm()
    {
        return $this->belongsTo(InspectionAmm::class, 'idinspectionamm');
    }
}
