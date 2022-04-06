<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FraisDossier extends Model
{
    protected $fillable = ['designation', 'valeur_int', 'valeur_str'];
}
