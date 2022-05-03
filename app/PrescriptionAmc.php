<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrescriptionAmc extends Model
{
    protected $fillable = ['dateprpt', 'value', 'comments', 'iduser', 'idamc', 'idprescription'];

    public function getPrescription()
    {
        return $this->belongsTo(Prescriptions::class, 'idprescription');
    }

    public function getAmc()
    {
        return $this->belongsTo(Amcs::class, 'idamc');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
