<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produits extends Model
{
    protected $fillable = ['code', 'libelle', 'montant', 'slug', 'categorieid'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($type) {
            $type->slug = Str::slug('pro-' . Str::random(50), '-');
        });
    }

    public function getCategorie() {
        return $this->belongsTo(CategorieProduit::class, 'categorieid');
    }

    public function getProduitAmms()
    {
        return $this->hasMany(ProduitAmms::class);
    }
}
