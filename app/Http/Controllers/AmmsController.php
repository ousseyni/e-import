<?php

namespace App\Http\Controllers;

use App\Amms;
use App\CategorieProduit;
use App\ConteneurAmm;
use App\Contribuables;
use App\DemandeComptes;
use App\DeviseEtrangere;
use App\DocumentAmms;
use App\ModeTransport;
use App\OrdreRecette;
use App\Pays;
use App\ProduitAmms;
use App\Produits;
use App\SuiviAmms;
use App\TypeContribuables;
use App\VehiculeAmm;
use App\VolAmm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $amms = Amms::all();
        return view('pages.amms.index', compact('amms'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $pays_pr = Pays::orderBy('libelle', 'ASC')->get();

        $categorie_produits = CategorieProduit::where('type', '=', 'AMM')->get();
        $produits = Produits::where('type', '=', 'AMM')->get();
        $pays_or = Pays::orderBy('libelle', 'ASC')->get();

        $mode_t = ModeTransport::all();

        $nif = Auth::user()->login;
        $contribuable = Contribuables::where('nif', '=', $nif)->firstOrFail();

        $tab_devise = DeviseEtrangere::orderBy('code', 'ASC')->get();

        return view('pages.amms.create',
            compact('pays_pr', 'contribuable', 'produits', 'mode_t',
                'pays_or', 'categorie_produits', 'tab_devise'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'paysprov' => 'max:200',
            'modetransport' => 'max:150',

            //'numlta' => 'max:100',
            //'cieaerien' => 'max:200',
            //'numvol' => 'max:200',

            //'nomnavire' => 'max:200',
            //'numvoyagem' => 'max:200',
            //'numbietc' => 'max:200',
            //'numconteneurm' => 'max:200',
            //'numconnaissement' => 'max:200',

            //'numlvi' => 'max:100',
            //'numvehicule' => 'max:200',
            //'numconteneurt' => 'max:200',

            //'numvoyagef' => 'max:200',
            //'numwagon' => 'max:200',

            'dateembarque' => 'date',
            'lieuembarque' => 'max:100',
            'datedebarque' => 'date',
            'lieudebarque' => 'max:100',

            'totalpoids' =>'numeric',
            'totalfrais' =>'numeric',
            'totalenr' =>'numeric',
            'totalglobal' =>'numeric',

            'valeurcaf_cfa' =>'numeric',
            'valeurcaf_ext' =>'numeric',
            'valeurcaf_dev' =>'max:10',

            'idcontribuable' =>'required|numeric',

            /*'pj1' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',
            'pj2' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',
            'pj3' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',
            'pj4' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',
            'pj5' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',*/
        ]);

        $show = Amms::create($validatedData);
        $contribuable = Contribuables::where('id', '=', $validatedData['idcontribuable'])->firstOrFail();

        $usager_folder = public_path('uploads/'.$contribuable->nif.'/amm_'.$show->id);
        if (!is_dir($usager_folder)) {
            mkdir($usager_folder, 0777, true);
        }

        //Sauvegarde des PJ
        $i = 0;
        $factures = $request->file('pj1');
        foreach($factures as $fact)
        {
            $i++;
            $name = "facture_fournisseur_$i.".$fact->extension();
            $fact->move($usager_folder, $name);

            DocumentAmms::create([
                'libelle' => 'Facture Fournisseur '.$i,
                'idamm' => $show->id,
                'pj' => $name
            ]);
        }

        $fiche_securite = 'fiche_securite.'.$request->pj2->extension();
        $request->pj2->move($usager_folder, $fiche_securite);
        DocumentAmms::create([
            'libelle' => 'Fiche Sécurité',
            'idamm' => $show->id,
            'pj' => $fiche_securite
        ]);

        $certificat_conformite = 'certificat_conformite.'.$request->pj3->extension();
        $request->pj3->move($usager_folder, $certificat_conformite);
        DocumentAmms::create([
            'libelle' => 'Certificat Conformité',
            'idamm' => $show->id,
            'pj' => $certificat_conformite
        ]);

        $cnt = 'cnt_lta_lv.'.$request->pj4->extension();
        $request->pj4->move($usager_folder, $cnt);
        DocumentAmms::create([
            'libelle' => 'CNT/LTA/LV',
            'idamm' => $show->id,
            'pj' => $cnt
        ]);

        $certificat_origine = 'certificat_origine.'.$request->pj5->extension();
        $request->pj5->move($usager_folder, $certificat_origine);
        DocumentAmms::create([
            'libelle' => "Certificat d'origine",
            'idamm' => $show->id,
            'pj' => $certificat_origine
        ]);

        if($request->hasFile('pj6')) {
            $ail = 'ail.'.$request->pj6->extension();
            $request->pj6->move($usager_folder, $ail);
            DocumentAmms::create([
                'libelle' => "Autorisation Spéciale des Lubrifiants",
                'idamm' => $show->id,
                'pj' => $ail
            ]);
        }

        if($request->hasFile('pj7')) {
            $asi = 'asi.'.$request->pj7->extension();
            $request->pj7->move($usager_folder, $asi);
            DocumentAmms::create([
                'libelle' => "Autorisation Spéciale d'Importation",
                'idamm' => $show->id,
                'pj' => $asi
            ]);
        }

        if($request->hasFile('pj8')) {
            $asipr = 'asipr.'.$request->pj8->extension();
            $request->pj8->move($usager_folder, $asipr);
            DocumentAmms::create([
                'libelle' => "Autorisation Spéciale d'Importation des produits réglementés (SAO & GES)",
                'idamm' => $show->id,
                'pj' => $asipr
            ]);
        }

        if($request->hasFile('pj9')) {
            $ldusr = 'ldusr.'.$request->pj9->extension();
            $request->pj9->move($usager_folder, $ldusr);
            DocumentAmms::create([
                'libelle' => "licence de détention/utilisation des substances réglementées",
                'idamm' => $show->id,
                'pj' => $ldusr
            ]);
        }

        if($request->hasFile('pj10')) {
            $cf = 'ldusr.'.$request->pj10->extension();
            $request->pj10->move($usager_folder, $cf);
            DocumentAmms::create([
                'libelle' => "Certificat de fumigation (riz & friperie)",
                'idamm' => $show->id,
                'pj' => $cf
            ]);
        }

        if($request->hasFile('pj11')) {
            $bietc = 'bietc.'.$request->pj10->extension();
            $request->pj10->move($usager_folder, $bietc);
            DocumentAmms::create([
                'libelle' => "Bordereau d'Identification Electronique de Traçabilité des Cargaisons",
                'idamm' => $show->id,
                'pj' => $bietc
            ]);
        }


        //Sauvegarde des produits associés à la demande
        $tab_produits = $_POST['produits'];
        //dd($request->$tab_produits);
        foreach($tab_produits as $data) {
            $numfact = $data['numfact'];
            $datefact = $data['datefact'];
            $fournisseur = $data['fournisseur'];
            $pays_or = $data['pays_or'];
            $produit = $data['idproduit'];
            $marque = $data['marque'];
            $poids = $data['poids'];
            $total = $data['total'];

            ProduitAmms::create([
                'idamm' => $show->id,
                'idproduit' => $produit,
                'numfact' => $numfact,
                'datefact' => $datefact,
                'fournisseur' => $fournisseur,
                'marque' => $marque,
                'paysorig' => $pays_or,
                'poids' => $poids,
                'total' => $total,
            ]);
        }

        //Sauvegarde des vols associés à la demande (Aérienne)
        if ($_POST['modetransport'] == 'Aérien') {
            VolAmm::create([
                'idamm' => $show->id,
                'numlta' => $_POST['numlta'],
                'cieaerien' => $_POST['cieaerien'],
                'numvol' => $_POST['numvol'],
            ]);
        }

        //Sauvegarde des conteneurs associés à la demande (Maritime)
        if ($_POST['modetransport'] == 'Maritime') {
            $tab_conteneurs = $_POST['conteneurs'];
            $nomnavire = $_POST['nomnavire'];
            $numvoyagem = $_POST['numvoyagem'];
            $numbietc = $_POST['numbietc'];
            $numconnaissement = $_POST['numconnaissement'];
            //dd($tab_conteneurs);
            foreach($tab_conteneurs as $data) {
                $numconteneur = $data['numconteneurm'];
                $numplomb = $data['numplombm'];

                ConteneurAmm::create([
                    'idamc' => $show->id,
                    'nomnavire' => $nomnavire,
                    'numvoyage' => $numvoyagem,
                    'numbietc' => $numbietc,
                    'numconteneur' => $numconteneur,
                    'numplomb' => $numplomb,
                    'numconnaissement' => $numconnaissement,
                ]);
            }
        }

        //Sauvegarde des vehicules associés à la demande (Terrestre)
        if ($_POST['modetransport'] == 'Terrestre') {
            $tab_vehicules = $_POST['vehicules'];
            //dd($tab_vehicules);
            foreach($tab_vehicules as $data) {
                $numlvi = $data['numlvi'];
                $numvehicule = $data['numvehicule'];
                $numconteneur = $data['numconteneurt'];
                $numplomb = $data['numplombt'];

                VehiculeAmm::create([
                    'idamm' => $show->id,
                    'numlvi' => $numlvi,
                    'numvehicule' => $numvehicule,
                    'numconteneur' => $numconteneur,
                    'numplomb' => $numplomb,
                ]);
            }
        }

        SuiviAmms::create([
            'idamm' => $show->id,
            'etat' => 1,
            'iduser' => Auth::id(),
            'comments' => "Nouvelle demande soumise à la DGCC",
        ]);

        return redirect('/amm')->with('success', "Demande d'Autorisation de Mise sur le Marché enregistrée avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($slug)
    {
        $amm = Amms::where('slug', '=', $slug)->firstOrFail();
        $doc_amms = DocumentAmms::where('idamm', '=', $amm->id)->get();
        return view('pages.amms.show', compact('amm', 'doc_amms'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function paiementodr($slug)
    {
        $amm = Amms::where('slug', '=', $slug)->firstOrFail();
        $odr = OrdreRecette::where('idamm', '=', $amm->id)->firstOrFail();
        return view('pages.amms.paiementodr', compact('amm', 'odr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function save_paiement(Request $request)
    {
        $validatedData = $request->validate([
            'numero_quittance' => 'required|max:200',
            'date_paye' => 'required',
            'pj_quittance' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',
        ]);
        $numero_quittance = $request->numero_quittance;

        if (OrdreRecette::where('quittance', '=', $numero_quittance)->exists()) {
            return redirect('/amm')->with('error', "Numéro de quittance non valide ou déjà utilisé ");
        }
        else {

            $idamm = $request->idamm;

            //Mettre à jour l'amm
            $amm = Amms::where('id', '=', $idamm)->firstOrFail();
            $amm->etat = 7;
            $amm->save();

            //Mettre à jour le paiement
            $odr = OrdreRecette::where('idamm', '=', $idamm)->firstOrFail();
            $odr->quittance = $request->numero_quittance;
            $odr->date_paye = $request->date_paye;
            $odr->est_paye = true;
            $odr->save();

            //Sauvegarder la quittance numérique
            $nif = auth()->user()->login;
            $usager_folder = public_path('uploads/'.$nif.'/amm_'.$idamm);
            if (!is_dir($usager_folder)) {
                mkdir($usager_folder, 0777, true);
            }

            $pj_quittance = 'pj_quittance.'.$request->pj_quittance->extension();
            $request->pj_quittance->move($usager_folder, $pj_quittance);
            DocumentAmms::create([
                'libelle' => "Quittance de paiement de l'odre de recette n° ".$odr->getNumOdr(),
                'idamm' => $idamm,
                'pj' => $pj_quittance
            ]);

            SuiviAmms::create([
                'idamm' => $idamm,
                'etat' => 7,
                'iduser' => Auth::id(),
                'comments' => "Paiement de l'ordre de recette n° ".$odr->getNumOdr(),
            ]);

            return redirect('/amm')->with('success', "Paiement de l'odre de recette effectué avec succès");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($slug)
    {
        $amm = Amms::where('slug', '=', $slug)->firstOrFail();
        return view('pages.amms.edit', compact('amm'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'numfact' => 'required|max:20',
            'datefact' => 'date',
            'paysorig' => 'max:50',
            'paysprov' => 'max:50',
            'fournisseur' => 'max:200',
            'nomnavire' => 'max:200',
            'cieaerien' => 'max:200',
            'numvehicul' => 'max:200',
            'numvoyage' => 'max:200',
            'numconteneur' => 'max:200',
            'numconnaissement' => 'max:200',
            'dateembarque' => 'date',
            'lieuembarque' => 'max:100',
            'datedebarque' => 'date',
            'lieudebarque' => 'max:100',
            'totalamm' =>'numeric',
            'totalpen' =>'numeric',
            'observation' => 'max:100',
            'totalpoids' =>'numeric',
            'valeurcaf' =>'numeric',
            'consoservice' =>'numeric',
            'idcontribuable' =>'required|numeric',
        ]);
        //Amms::whereId($id)->update($validatedData);
        Amms::where('slug', '=', $slug)->update($validatedData);

        return redirect('/amms')->with('success', 'AMM modifiée avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($slug)
    {
        $amm = Amms::where('slug', '=', $slug)->firstOrFail();
        $amm->delete();

        return redirect('/amm')->with('success', 'Demande de AMM supprimée avec succès');

    }

}
