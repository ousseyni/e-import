<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtatDemande extends Model
{
    protected $fillable = ['libelle_dgcc', 'libelle_user'];

    public function getAmm(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Amms::class);
    }

    public function getAmc(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Amcs::class);
    }
}
