<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuiviAmms extends Model
{
    protected $fillable = ['etat', 'idamm', 'iduser', 'comments'];

    public function getAmm()
    {
        return $this->belongsTo(Amms::class, 'idamm');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
