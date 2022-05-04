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
        return $this->hasMany(VolAmc::class, 'idamc', 'id');
    }

    public function getConteneurs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ConteneurAmc::class, 'idamc', 'id');
    }

    public function getVehicules(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VehiculeAmc::class, 'idamc', 'id');
    }

    public function getSuivis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SuiviAmms::class, 'idamc', 'id');
    }

    public function getProduitAmcs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProduitAmcs::class, 'idamc', 'id');
    }

    public function getDocumentAmcs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DocumentAmcs::class, 'idamc', 'id');
    }

    public function getPrescriptions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PrescriptionAmc::class, 'idamc', 'id');
    }

    public function getEtat(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EtatDemande::class, 'etat');
    }

    public function estDepote() {
        $estDepote = false;
        foreach ($this->getPrescriptions as $prescription_amc) {
            if ($prescription_amc->idprescription == 2) {
                $estDepote = true;
            }
        }
        return $estDepote;
    }

    public function haveOrdreRecette()
    {
        $haveOrdreRecette = false;
        if (OrdreRecetteAmm::where('idamm', '=', $this->id)->exists()) {
            $haveOrdreRecette = true;
        }
        return $haveOrdreRecette;
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
