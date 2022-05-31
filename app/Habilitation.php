<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habilitation extends Model
{
    protected $fillable = ['libelle', 'categorie'];

    public function getProfils(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Profils::class);
    }
}
