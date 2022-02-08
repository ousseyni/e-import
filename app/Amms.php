<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amms extends Model
{
    protected $fillable = ['numfact', 'datefact', 'paysorig', 'paysprov', 'fournisseur', 'nomnavire', 'cieaerien',
        'numvehicul', 'numvoyage', 'numconteneur', 'numconnaissement', 'dateembarque', 'lieuembarque', 'datedebarque',
        'lieudebarque', 'totalamm', 'totalpen', 'observation', 'totalpoids', 'valeurcaf', 'consoservice', 'idcontribuable','slug'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($type) {
            $type->slug = Str::slug('amm-'.Str::random(50), '-');
        });
    }
    public function getContribuables()
    {
        return $this->belongsTo(Contribuables::class, 'contribuableid');
    }
}
