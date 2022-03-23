<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SousActivite extends Model
{
    protected $fillable = ['code', 'libelle', 'slug', 'activiteid'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($type) {
            $type->slug = Str::slug('sactiv-' . Str::random(50), '-');
        });
    }

    public function getActivite() {
        return $this->belongsTo(Activite::class, 'activiteid');
    }
}
