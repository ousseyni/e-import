<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InspectionAmm extends Model
{
    protected $fillable = ['dateinspection', 'paysprov', 'modetransport', 'conditiontransport',
        'poinentree', 'lieuinspection', 'natureproduits', 'totalqte', 'idamm', 'conclusion',
        'observation', 'iduser', 'idcontribuable'];

    public function getAmm()
    {
        return $this->belongsTo(Amms::class, 'idamm');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function getContribuable()
    {
        return $this->belongsTo(Contribuables::class, 'idcontribuable');
    }

}
