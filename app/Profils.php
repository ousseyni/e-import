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

    public function getUsers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }

    public function getHabilitations(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Habilitation::class);
    }

    public function get_droit_profil() {
        $tab_droit = array();
        foreach($this->getHabilitations as $droit) {
            $tab_droit[] = $droit->id;
        }
        return $tab_droit;
    }
}
