<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProduitAmms extends Model
{
    protected $fillable = ['numfact', 'datefact', 'fournisseur', 'marque', 'paysorig',
        'poids', 'total', 'idamm', 'idproduit', 'paysorig'];

    public function getProduit()
    {
        return $this->belongsTo(Produits::class, 'idproduit');
    }

    public function getAmm()
    {
        return $this->belongsTo(Amms::class, 'idamm');
    }
}
