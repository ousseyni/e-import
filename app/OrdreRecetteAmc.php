<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdreRecetteAmc extends Model
{
    protected $fillable = ['exercice', 'date_emission', 'est_paye', 'date_paye', 'idamc'];

    public function getAmc()
    {
        return $this->belongsTo(Amcs::class, 'idamc');
    }
}
