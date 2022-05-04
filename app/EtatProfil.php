<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtatProfil extends Model
{
    protected $fillable = ['idprofil', 'etat'];

    public function getEtat() {
        return $this->belongsTo(EtatDemande::class, 'etat');
    }

    public function getProfil() {
        return $this->belongsTo(Profils::class, 'idprofil');
    }
}
