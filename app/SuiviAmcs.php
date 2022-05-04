<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuiviAmcs extends Model
{
    protected $fillable = ['etat', 'idamc', 'iduser', 'comments'];

    public function getAmc()
    {
        return $this->belongsTo(Amms::class, 'idamm');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
