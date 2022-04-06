<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Amms extends Model
{
    /*protected $fillable = ['paysprov', 'modetransport', 'numlta', 'cieaerien', 'numvol', 'nomnavire', 'numvoyagem',
        'numbietc', 'numconteneurm', 'numconnaissement', 'numlvi', 'numvehicule', 'numconteneurt', 'numvoyagef',
        'numwagon', 'dateembarque', 'lieuembarque', 'datedebarque', 'lieudebarque', 'totalfrais', 'totalpen',
        'observation', 'totalpoids', 'valeurcaf_cfa', 'valeurcaf_ext', 'valeurcaf_dev', 'consoservice',
        'idcontribuable', 'slug'];*/

    protected $fillable = ['paysprov', 'modetransport', 'dateembarque', 'lieuembarque', 'datedebarque', 'lieudebarque',
        'totalpoids', 'totalfrais', 'totalenr', 'totalpen', 'totalglobal', 'observation', 'valeurcaf_cfa',
        'valeurcaf_ext', 'valeurcaf_dev', 'idcontribuable', 'slug'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($type) {
            $type->slug = Str::slug('amm-'.Str::random(50), '-');
        });
    }

    public function getContribuable(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Contribuables::class, 'idcontribuable');
    }

    public function getSuivis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SuiviAmms::class);
    }

    public function getVols(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VolAmm::class);
    }

    public function getConteneurs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ConteneurAmm::class);
    }

    public function getVehicules(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VehiculeAmm::class);
    }

    public function getProduitAmms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProduitAmms::class, 'idamm', 'id');
    }

    public function getDocumentAmms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DocumentAmms::class, 'idamm', 'id');
    }

    public function getEtat(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EtatDemande::class, 'etat');
    }

    public function getNumDemande(): string
    {
        $id = $this->id;
        $value = "#".$id;
        if (strlen($id) == 1) {
            $value = "#00000".$id;
        }
        if (strlen($id) == 2) {
            $value = "#0000".$id;
        }
        if (strlen($id) == 3) {
            $value = "#000".$id;
        }
        if (strlen($id) == 4) {
            $value = "#00".$id;
        }
        if (strlen($id) == 5) {
            $value = "#0".$id;
        }
        return $value;
    }
}
