<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Amms extends Model
{
    protected $fillable = ['numfact', 'datefact', 'paysprov', 'modetransport', 'fournisseur',
        'cieaerien', 'numvoyagea', 'nomnavire', 'numvoyagem', 'numvehicul', 'numvoyaget', 'numwagon', 'numvoyagef',
        'numconteneur', 'numconnaissement', 'dateembarque', 'lieuembarque', 'datedebarque', 'lieudebarque',
        'totalamm', 'totalpen', 'observation', 'totalpoids', 'valeurcaf', 'consoservice', 'idcontribuable',
        'slug'];

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
