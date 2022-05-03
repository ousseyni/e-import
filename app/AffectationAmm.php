<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffectationAmm extends Model
{
    protected $fillable = ['est_traite', 'idamm', 'iduser', 'comments'];

    public function getAmm()
    {
        return $this->belongsTo(Amms::class, 'idamm');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
