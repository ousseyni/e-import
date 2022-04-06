<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProduitAmcs extends Model
{
    protected $fillable = ['numfact', 'datefact', 'fournisseur', 'marque', 'paysorig',
        'poids', 'total', 'idamc', 'idproduit', 'paysorig'];

    public function getProduit()
    {
        return $this->belongsTo(Produits::class, 'idproduit');
    }

    public function getAmc()
    {
        return $this->belongsTo(Amcs::class, 'idamc');
    }
}
