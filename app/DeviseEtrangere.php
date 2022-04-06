<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviseEtrangere extends Model
{
    protected $fillable = ['code', 'libelle', 'taux'];
}
