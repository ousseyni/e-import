<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InspectionAmc extends Model
{
    protected $fillable = ['dateinspection', 'paysprov', 'modetransport', 'conditiontransport',
        'poinentree', 'lieuinspection', 'natureproduits', 'totalqte', 'idamc', 'conclusion',
        'observation', 'iduser', 'idcontribuable'];

    public function getAmc()
    {
        return $this->belongsTo(Amcs::class, 'idamc');
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
