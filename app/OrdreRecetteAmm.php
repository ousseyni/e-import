<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdreRecetteAmm extends Model
{
    protected $fillable = ['exercice', 'date_emission', 'est_paye', 'date_paye', 'idamm', 'quittance'];

    public function getAmm()
    {
        return $this->belongsTo(Amms::class, 'idamm');
    }

    public function getNumOdr(): string
    {
        $value = $this->id;
        if (strlen($this->id) == 1) {
            $value = "00000".$this->id;
        }
        if (strlen($this->id) == 2) {
            $value = "0000".$this->id;
        }
        if (strlen($this->id) == 3) {
            $value = "000".$this->id;
        }
        if (strlen($this->id) == 4) {
            $value = "00".$this->id;
        }
        if (strlen($this->id) == 5) {
            $value = "0".$this->id;
        }
        return $value;
    }
}
