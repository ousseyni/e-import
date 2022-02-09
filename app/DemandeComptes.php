<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DemandeComptes extends Model
{
    protected $fillable = ['nif', 'raisonsociale', 'typecontribuableid',
        'tel', 'email', 'pj', 'slug'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($type) {
            $type->slug = Str::slug('demande-'.Str::random(50), '-');
        });
    }

    public function getTypeContribuables()
    {
        return $this->belongsTo(TypeContribuables::class, 'typecontribuableid');
    }

}
