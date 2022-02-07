<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TypeContribuables extends Model
{
    protected $fillable = ['libelle', 'slug'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($type) {
            $type->slug = Str::slug('typectb-'.Str::random(50), '-');
        });
    }
    public function getContribuables()
    {
        return $this->hasMany(Contribuables::class);
    }
}
