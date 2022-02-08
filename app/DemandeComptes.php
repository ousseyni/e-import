<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemandeComptes extends Model
{
    protected $fillable = ['nif', 'nom', 'num', 'email', 'piecesjointes', 'slug'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($type) {
            $type->slug = Str::slug('demande-'.Str::random(50), '-');
        });
    }

}
