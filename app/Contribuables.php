<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contribuables extends Model
{
    protected $fillable = ['nif', 'raisonsocial', 'rccm', 'bp', 'tel', 'email', 'numagrement', 'numcartecomm', 'typecontribuableid', 'slug'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($type) {
            $type->slug = Str::slug('contri-'.Str::random(50), '-');
        });
    }
    public function getTypeContribuables()
    {
        return $this->belongsTo(TypeContribuables::class, 'typecontribuableid');
    }
}
