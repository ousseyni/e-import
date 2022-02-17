<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amcs extends Model
{
    protected $fillable = ['numfact', 'datefact', 'paysorig', 'paysprov', 'fournisseur', 'nomnavire', 'cieaerien',
        'numvehicul', 'numvoyage', 'numconteneur', 'numconnaissement', 'dateembarque', 'lieuembarque', 'datedebarque',
        'lieudebarque', 'totalamc', 'totalpen', 'observation', 'totalpoids', 'valeurcaf', 'consoservice', 'idcontribuable','slug'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($type) {
            $type->slug = Str::slug('amc-'.Str::random(50), '-');
        });
    }
    public function getContribuables()
    {
        return $this->belongsTo(Contribuables::class, 'contribuableid');
    }

    public function getSuivis()
    {
        return $this->hasMany(SuiviAmcs::class);
    }

    public function getProduits()
    {
        return $this->hasMany(Produits::class);
    }
}
