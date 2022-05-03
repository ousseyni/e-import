<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Profils extends Model
{
    protected $fillable = ['libelle', 'slug'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($type) {
            $type->slug = Str::slug('prf-'.Str::random(50), '-');
        });
    }

    public function getUsers()
    {
        return $this->hasMany(User::class);
    }
}
