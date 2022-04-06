<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VolAmc extends Model
{
    protected $fillable = ['numlta', 'cieaerien', 'numvol', 'idamc'];

    public function getAmc()
    {
        return $this->belongsTo(Amcs::class, 'idamc');
    }
}
