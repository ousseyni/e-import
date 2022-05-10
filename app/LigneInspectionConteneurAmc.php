<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LigneInspectionConteneurAmc extends Model
{
    protected $fillable = ['conteneurinspecte', 'numeroplomb', 'idinspectionamc'];

    public function getInspectionAmc()
    {
        return $this->belongsTo(InspectionAmc::class, 'idinspectionamc');
    }
}
