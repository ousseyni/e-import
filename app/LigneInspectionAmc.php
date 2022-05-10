<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LigneInspectionAmc extends Model
{
    protected $fillable = ['marque', 'nom', 'numerolot', 'paysorig', 'fournisseur', 'fabricant',
        'ingredients', 'qtenet', 'durabilite', 'modeemploi', 'allegation', 'datefact', 'poids',
        'possede2aire', 'observation2aire', 'etat2aire', 'possede1aire', 'observation1aire', 'etat1aire',
        'autreobservation', 'idinspectionamc', 'idproduitamc'];

    public function getInspectionAmc()
    {
        return $this->belongsTo(InspectionAmm::class, 'idinspectionamc');
    }

    public function getProduitAmc()
    {
        return $this->belongsTo(ProduitAmcs::class, 'idproduitamc');
    }
}
