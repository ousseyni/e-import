<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Amcs extends Model
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
            $type->slug = Str::slug('amc-'.Str::random(50), '-');
        });
    }

    public function getContribuable(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Contribuables::class, 'idcontribuable');
    }

    public function getVols(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VolAmc::class);
    }

    public function getConteneurs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ConteneurAmc::class);
    }

    public function getVehicules(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VehiculeAmc::class);
    }

    public function getSuivis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SuiviAmms::class);
    }

    public function getProduitAmcs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProduitAmcs::class, 'idamc', 'id');
    }

    public function getDocumentAmcs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DocumentAmcs::class, 'idamc', 'id');
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
