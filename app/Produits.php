<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produits extends Model
{
    protected $fillable = ['code', 'libelle', 'type', 'montant', 'slug', 'categorie_produit_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($type) {
            $type->slug = Str::slug('pro-' . Str::random(50), '-');
        });
    }

    public function getCategorie() {
        return $this->belongsTo(CategorieProduit::class, 'categorie_produit_id', 'id');
    }

    public function getProduitAmms()
    {
        return $this->hasMany(ProduitAmms::class);
    }
}
