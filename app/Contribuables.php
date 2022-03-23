<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contribuables extends Model
{
    protected $fillable = ['nif', 'typecontribuableid', 'activiteid', 'sousactiviteid', 'raisonsociale', 'siegesocial', 'bp', 'tel',
                           'rccm', 'numagrement', 'numcartecomm', 'nomprenom', 'email', 'pj', 'slug'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($type) {
            $type->slug = Str::slug('contri-'.Str::random(50), '-');
        });
    }
    public function getTypeContribuables()
    {
        return $this->belongsTo(TypeContribuables::class, 'typecontribuableid');
    }

    public function getActivite()
    {
        return $this->belongsTo(Activite::class, 'activiteid');
    }

    public function getSousActivite()
    {
        return $this->belongsTo(SousActivite::class, 'sousactiviteid');
    }
}
