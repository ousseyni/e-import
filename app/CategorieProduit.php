<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategorieProduit extends Model
{
    protected $fillable = ['libelle', 'montant'];
}
