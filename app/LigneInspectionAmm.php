<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LigneInspectionAmm extends Model
{
    protected $fillable = ['marque', 'nom', 'numerolot', 'paysorig', 'fournisseur', 'fabricant',
        'ingredients', 'qtenet', 'durabilite', 'modeemploi', 'allegation', 'datefact', 'poids',
        'possede2aire', 'observation2aire', 'etat2aire', 'possede1aire', 'observation1aire', 'etat1aire',
        'autreobservation', 'idinspectionamm', 'idproduit'];

    public function getInspectionAmm()
    {
        return $this->belongsTo(InspectionAmm::class, 'idinspectionamm');
    }

    public function getProduit()
    {
        return $this->belongsTo(Produits::class, 'idproduit');
    }
}
