<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrescriptionAmm extends Model
{
    protected $fillable = ['dateprpt', 'value', 'comments', 'iduser', 'idamm', 'idprescription'];

    public function getPrescription()
    {
        return $this->belongsTo(Prescriptions::class, 'idprescription');
    }

    public function getAmm()
    {
        return $this->belongsTo(Amms::class, 'idamm');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
