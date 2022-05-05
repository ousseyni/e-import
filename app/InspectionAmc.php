<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InspectionAmc extends Model
{
    protected $fillable = ['dateinspection', 'conditiontransport', 'poinentree', 'lieuinspection',
        'conteneurinspecte', 'numeroplomb', 'natureproduits', 'totalqte', 'idamc', 'conclusion',
        'observation', 'iduser', 'idcontribuable'];

    public function getAmc()
    {
        return $this->belongsTo(Amms::class, 'idamc');
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
