<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffectationAmc extends Model
{
    protected $fillable = ['est_traite', 'idamc', 'iduser', 'comments'];

    public function getAmc()
    {
        return $this->belongsTo(Amcs::class, 'idamc');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
