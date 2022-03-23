<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Activite extends Model
{
    protected $fillable = ['code', 'libelle', 'slug'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($type) {
            $type->slug = Str::slug('act-'.Str::random(50), '-');
        });
    }

    public function getSousActivite()
    {
        return $this->hasMany(SousActivite::class);
    }
}
