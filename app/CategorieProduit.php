<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategorieProduit extends Model
{
    protected $fillable = ['libelle', 'montant', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($type) {
            $type->slug = Str::slug('catepro-' . Str::random(50), '-');
        });
    }
}