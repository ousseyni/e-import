<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
    public function getContribuable()
    {
        return $this->belongsTo(Contribuables::class, 'idcontribuable');
    }

    public function getSuivis()
    {
        return $this->hasMany(SuiviAmms::class);
    }

    public function getProduitAmms()
    {
        return $this->hasMany(ProduitAmms::class, 'idamm', 'id');
    }
}
