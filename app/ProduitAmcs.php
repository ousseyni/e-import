<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProduitAmcs extends Model
{
    protected $fillable = ['idamc', 'idproduit', 'poids', 'total'];

    public function getProduit()
    {
        return $this->belongsTo(Produits::class, 'idproduit');
    }

    public function getAmc()
    {
        return $this->belongsTo(Amcs::class, 'idamc');
    }
}
