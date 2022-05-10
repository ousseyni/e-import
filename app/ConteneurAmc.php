<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConteneurAmc extends Model
{
    protected $fillable = ['nomnavire', 'numvoyage', 'numbietc', 'numconnaissement', 'numconteneur', 'numplomb', 'idamc'];

    public function getAmc()
    {
        return $this->belongsTo(Amcs::class, 'idamc');
    }
}
