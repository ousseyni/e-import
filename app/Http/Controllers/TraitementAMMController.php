<?php

namespace App\Http\Controllers;

use App\AffectationAmm;
use App\Amms;
use App\CategorieProduit;
use App\ConteneurAmm;
use App\Contribuables;
use App\DeviseEtrangere;
use App\DocumentAmms;
use App\EtatDemande;
use App\InspectionAmm;
use App\LigneInspectionAmm;
use App\LigneInspectionConteneurAmm;
use App\ModeTransport;
use App\OrdreRecette;
use App\Pays;
use App\PrescriptionAmm;
use App\Prescriptions;
use App\ProduitAmms;
use App\Produits;
use App\SuiviAmms;
use App\User;
use App\VehiculeAmm;
use App\VolAmm;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TraitementAMMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function new()
    {
        $pays_pr = Pays::orderBy('libelle', 'ASC')->get();

        $categorie_produits = CategorieProduit::where('type', '=', 'AMM')->get();
        $produits = Produits::where('type', '=', 'AMM')->get();
        $pays_or = Pays::orderBy('libelle', 'ASC')->get();

        $mode_t = ModeTransport::all();

        $tab_devise = DeviseEtrangere::orderBy('code', 'ASC')->get();

        return view('pages.traitement-amm.new',
            compact('pays_pr', 'produits', 'mode_t',
                'pays_or', 'categorie_produits', 'tab_devise'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function saveamm(Request $request)
    {
        $validatedData = $request->validate([
            'paysprov' => 'max:200',
            'modetransport' => 'max:150',

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

            'nif' =>'required',
            'idcontribuable' =>'numeric',
        ]);

        $show = Amms::create($validatedData);
        $contribuable = Contribuables::where('nif', '=', $validatedData['nif'])->firstOrFail();

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
        //dd($tab_produits);
        foreach($tab_produits as $data) {
            if ($data['numfact'] != "") {
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
                if ($data['numconteneurm'] != "") {
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
        }

        //Sauvegarde des vehicules associés à la demande (Terrestre)
        if ($_POST['modetransport'] == 'Terrestre') {
            $tab_vehicules = $_POST['vehicules'];
            //dd($tab_vehicules);
            foreach($tab_vehicules as $data) {
                if ($data['numlvi'] != "") {
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
        }

        SuiviAmms::create([
            'idamm' => $show->id,
            'etat' => 1,
            'iduser' => Auth::id(),
            'comments' => "Nouvelle demande soumise à la DGCC",
        ]);

        return redirect('/traitement-amm/new')->with('success', "Demande d'Autorisation de Mise sur le Marché enregistrée avec succès");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function etude()
    {
        $etat = array(1, 2, 3, 4, 998, 999, 9991);
        $demandes_etudes = Amms::whereIn('etat', $etat)->paginate(10);

        return view('pages.traitement-amm.etude', compact('demandes_etudes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function valide()
    {
        $etat = array(5, 6, 7, 8, 9);
        $demandes_etudes = Amms::whereIn('etat', $etat)->paginate(10);

        return view('pages.traitement-amm.valide', compact('demandes_etudes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function traite()
    {
        $etat = array(10);
        $demandes_etudes = Amms::whereIn('etat', $etat)->paginate(10);

        return view('pages.traitement-amm.traite', compact('demandes_etudes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function state()
    {
        $demandes_etudes = Amms::paginate(10);

        return view('pages.traitement-amm.state', compact('demandes_etudes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function trace($slug)
    {
        $amm = Amms::where('slug', '=', $slug)->firstOrFail();
        $traces = SuiviAmms::where('idamm', '=', $amm->id)->orderBy('created_at', 'DESC')->get();
        $tab_color = array('primary', 'success', 'info', 'warning', 'danger', 'danger');

        return view('pages.traitement-amm.trace',
            compact('amm', 'traces', 'tab_color'));
    }


    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function traitement($slug)
    {
        $amm = Amms::where('slug', '=', $slug)->firstOrFail();

        $etat_demande = EtatDemande::where('etat_actuel', '=', $amm->etat)->firstOrFail();
        $tab_suivant = array();
        if ($etat_demande->etat_suivant != '') {
            $etat_suivant = explode('-', $etat_demande->etat_suivant);
            foreach ($etat_suivant as $suivant) {
                $tab_suivant[] = EtatDemande::where('etat_actuel', '=', $suivant)->firstOrFail();
            }
        }

        //dd($tab_suivant);
        $users = User::where('profilid', '!=', 2)->get();

        $precriptions = Prescriptions::all();

        $odr = "";
        if ($amm->etat >= 6 && $amm->etat != 998 && $amm->etat != 999) {
            $odr = OrdreRecette::where('idamm', '=', $amm->id)->firstOrFail();
        }

        return view('pages.traitement-amm.traitement',
            compact('amm', 'users', 'tab_suivant', 'precriptions', 'odr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $amm = Amms::where('slug', '=', $request->slug)->firstOrFail();
        $action = $request->traitement_demande;

        if ($action == "affecter_demande") {
            $list_user = $request->affecter_demande;
            //dd($list_user);

            foreach ($list_user as $userid) {
                AffectationAmm::create([
                    'est_traite' => false,
                    'idamm' => $amm->id,
                    'iduser' => $userid,
                    'comments' => "Transmission aux agents - étude à effectuer",
                ]);
            }

            SuiviAmms::create([
                'idamm' => $amm->id,
                'etat' => 2,
                'iduser' => Auth::id(),
                'comments' => "Transmission aux agents - étude à effectuer",
            ]);

            $amm->etat = 2;
        }
        else {
            $new_etat = $request->traiter_demande;
            $old_etat = $request->old_etat;

            //dd($old_etat);
            //Enregistrement des prescriptions ou avis effectuées

            if ($old_etat == 1) {
                $prescriptions = $new_etat;
                if (count($prescriptions) == 1 && $prescriptions[0] == 1) {
                    $comments = "Rien à signaler";
                }
                else {
                    $comments = "Visite de la DGCC pour inspection Contacts : 061 000 196 / 061 000 202";
                }

                foreach ($prescriptions as $prescription) {
                    PrescriptionAmm::create([
                        'dateprpt' => date('Y-m-d'),
                        'comments' => $comments,
                        'iduser' => Auth::id(),
                        'idamm' => $amm->id,
                        'idprescription' => $prescription,
                    ]);
                }
                $new_etats = 3;
                $etat = EtatDemande::where('id', '=', $new_etats)->firstOrFail();
                $comments = $etat->libelle_dgcc;

                SuiviAmms::create([
                    'idamm' => $amm->id,
                    'etat' => $new_etats,
                    'iduser' => Auth::id(),
                    'comments' => $comments,
                ]);

                $amm->etat = $new_etats;
            }

            if ($new_etat == 3) {
                $prescriptions = $request->prescriptions;
                if (count($prescriptions) == 1 && $prescriptions[0] == 1) {
                    $comments = "Rien à signaler";
                }
                else {
                    $comments = "Visite de la DGCC pour inspection Contacts : 061 000 196 / 061 000 202";
                }
                //echo $comments;
                //dd($prescriptions);
                //$comments = $request->comments_avis;
                foreach ($prescriptions as $prescription) {
                    PrescriptionAmm::create([
                        'dateprpt' => date('Y-m-d'),
                        'comments' => $comments,
                        'iduser' => Auth::id(),
                        'idamm' => $amm->id,
                        'idprescription' => $prescription,
                    ]);
                }
            }

            //Génération d'un ODR
            if ($new_etat == 6) {
                OrdreRecette::create([
                    'exercice' => date('Y'),
                    'date_emission' => date('Y-m-d'),
                    'quittance' => "",
                    'type' => "AMM",
                    'est_paye' => false,
                    'idamm' => $amm->id
                ]);
            }

            //Enregistrement de la fiche de crtl renseignée
            /*if ($old_etat == 4) {
                $usager_folder = public_path('uploads/'.$amm->getContribuable->nif.'/amm_'.$amm->id);
                if (!is_dir($usager_folder)) {
                    mkdir($usager_folder, 0777, true);
                }

                $fiche_crtl = 'fiche_crtl_renseignee.'.$request->fiche_crtl->extension();
                $request->fiche_crtl->move($usager_folder, $fiche_crtl);
                DocumentAmms::create([
                    'libelle' => 'Fiche de contrôle renseignée',
                    'idamm' => $amm->id,
                    'pj' => $fiche_crtl
                ]);

                $amm->totalpen = $request->totalpen;
                $amm->totalglobal += $request->totalpen;
                $amm->save();
            }*/

            if ($old_etat != 1) {
                $etat = EtatDemande::where('id', '=', $new_etat)->firstOrFail();
                $comments = $etat->libelle_dgcc;

                if ($new_etat == 998 || $new_etat == 999) {
                    $comments = $request->comments_traitement;
                }

                SuiviAmms::create([
                    'idamm' => $amm->id,
                    'etat' => $new_etat,
                    'iduser' => Auth::id(),
                    'comments' => $comments,
                ]);

                $amm->etat = $new_etat;
            }

        }
        $amm->save();

        $link = 'etude';
        if ($amm->etat >= 5 && $amm->etat <= 9) {
            $link = 'valide';
        }
        elseif ($amm->etat == 10) {
            $link = 'traite';
        }



        return redirect('/traitement-amm/'.$link)->with('success', "Traitement de la demande d'AMM enregistré avec succès");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function saverapport(Request $request)
    {
        $amm = Amms::where('slug', '=', $request->slugamm)->firstOrFail();

        $newInspection = InspectionAmm::create([
            'dateinspection' => date('Y-m-d H:i:s'),
            'paysprov' => $request->paysprov,
            'modetransport' => $request->modetransport,
            'conditiontransport' => $request->conditiontransport,
            'poinentree' => $request->poinentree,
            'lieuinspection' => $request->lieuinspection,
            'comment_transport' => $request->comment_transport,
            'natureproduits' => $request->natureproduits,
            'totalqte' => $request->totalqte,
            'idamm' => $amm->id,
            'conclusion' => $request->conclusion,
            'observation' => $request->observation,
            'iduser' => Auth::id(),
            'idcontribuable' => $request->idcontribuable,
        ]);

        //Sauvegarde des produits associés à la demande
        $tab_produits = $_POST['produits'];
        //dd($tab_produits);
        foreach($tab_produits as $data) {
            if ($data['idproduitamm'] != '') {
                $produit = Produits::where('id', '=', $data['idproduitamm'])->firstOrFail();
                LigneInspectionAmm::create([
                    'marque' => $data['marque'],
                    'nom' => $produit->libelle,
                    'numerolot' => $data['numerolot'],
                    'paysorig' => $data['paysorig'],
                    'fournisseur' => $data['fabricant'],
                    'fabricant' => $data['fabricant'],
                    'ingredients' => $data['ingredients'],
                    'qtenet' => $data['qtenet'],
                    'durabilite' => $data['durabilite'],
                    'modeemploi' => $data['modeemploi'],
                    'allegation' => $data['allegation'],
                    'possede2aire' => $data['possede2aire'],
                    'etat2aire' => $data['etat2aire'],
                    'possede1aire' => $data['possede1aire'],
                    'etat1aire' => $data['etat1aire'],
                    'autreobservation' => $data['autreobservation'],
                    'idinspectionamm' => $newInspection->id,
                    'idamm' => $amm->id,
                    'idproduitamm' => $data['idproduitamm'],
                ]);
            }
        }

        $nb = 0;
        if ($amm->modetransport == 'Maritime') {
            $nb = ConteneurAmm::where('idamm', '=', $amm->id)->count();
        }
        if ($amm->modetransport == 'Terrestre') {
            $nb = VehiculeAmm::where('idamm', '=', $amm->id)->count();
        }

        for($i=0; $i<$nb; $i++) {
            LigneInspectionConteneurAmm::create([
                'conteneurinspecte' => $_POST['conteneurinspecte_'.$i],
                'numeroplomb' => $_POST['numeroplomb_'.$i],
                'idinspectionamm' => $newInspection->id,
            ]);
        }

        //Sauvegarde des produits associés à la demande
        $tab_conteneurs = $_POST['conteneurs'];
        foreach($tab_conteneurs as $data) {
            if ($data['conteneurinspecte'] != '') {
                LigneInspectionConteneurAmm::create([
                    'conteneurinspecte' => $data['conteneurinspecte'],
                    'numeroplomb' => $data['numeroplomb'],
                    'idinspectionamm' => $newInspection->id,
                ]);
            }
        }

        SuiviAmms::create([
            'idamm' => $amm->id,
            'etat' => $amm->etat,
            'iduser' => Auth::id(),
            'comments' => "Création du rapport d'inspection",
        ]);

        $link = 'etude';
        if ($amm->etat >= 5 && $amm->etat <= 9) {
            $link = 'valide';
        }
        elseif ($amm->etat == 10) {
            $link = 'traite';
        }

        return redirect('/traitement-amm/'.$link)->with('success', "Traitement de la demande d'AMM enregistré avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function rapport($slug)
    {
        $amm = Amms::where('slug', '=', $slug)->firstOrFail();

        $pays_pr = Pays::orderBy('libelle', 'ASC')->get();
        $pays_or = Pays::orderBy('libelle', 'ASC')->get();

        $produitsAmm = ProduitAmms::where('idamm', '=', $amm->id)->get();
        $tab_pamm = array();
        foreach ($produitsAmm as $produit) {
            $tab_pamm[] = $produit->idproduit;
        }
        $conteneursAmm = null;
        $categorie_produits = CategorieProduit::where('type', '=', 'AMM')->get();
        if ($amm->modetransport == 'Maritime') {
            $conteneursAmm = ConteneurAmm::where('idamm', '=', $amm->id)->get();
        }
        if ($amm->modetransport == 'Terrestre') {
            $conteneursAmm = VehiculeAmm::where('idamm', '=', $amm->id)->get();
        }

        $mode_t = ModeTransport::all();

        $conditions_tp = array('Ambiante', 'Refrigéré', 'Surgelé');

        $nif = $amm->getContribuable->nif;
        $contribuable = Contribuables::where('nif', '=', $nif)->firstOrFail();

        return view('pages.traitement-amm.rapport',
            compact('pays_pr', 'contribuable', 'produitsAmm', 'mode_t',
                'pays_or', 'conteneursAmm', 'amm', 'conditions_tp', 'categorie_produits',
                'tab_pamm'));
    }

    public function dwlord($slug) {

        $amm = Amms::where('slug', '=', $slug)->firstOrFail();
        $odr = OrdreRecette::where('idamm', '=', $amm->id)->firstOrFail();

        $image = base64_encode(file_get_contents(public_path('/storage/img/gabon.jpg')));
        $filigrane = base64_encode(file_get_contents(public_path('/storage/img/filigrane.png')));
        $sign_odr = base64_encode(file_get_contents(public_path('/storage/pdf/sign_odr.png')));

        $pdf = PDF::loadView('pages.traitement-amm.odr',
            compact('amm', 'image', 'filigrane', 'odr', 'sign_odr'));

        $filename = "ORD_AMM_".$amm->getNumDemande().".pdf";
        //return $pdf->download($filename);
        return $pdf->stream($filename, array("Attachment" => false));
    }

    public function dwlamm($slug) {

        $amm = Amms::where('slug', '=', $slug)->firstOrFail();
        $suivi = SuiviAmms::where('idamm', '=', $amm->id)
                          ->where('etat', '=', 8)->firstOrFail();
        $prescriptions = PrescriptionAmm::where('idamm', '=', $amm->id)->get();

        $image = base64_encode(file_get_contents(public_path('/storage/pdf/back_amm.png')));

        $agent = base64_encode(file_get_contents(public_path('/storage/pdf/agent.png')));
        $chef = base64_encode(file_get_contents(public_path('/storage/pdf/chef.png')));
        $dir = base64_encode(file_get_contents(public_path('/storage/pdf/dir.png')));
        $dg = base64_encode(file_get_contents(public_path('/storage/pdf/dg.png')));
        $filigrane = base64_encode(file_get_contents(public_path('/storage/img/filigrane.png')));

        $nif = $amm->getContribuable->nif;
        Qrcode::size(100)->generate(url('/verify-doc/AMM/'.$amm->slug), public_path("/uploads/$nif/amm_".$amm->id."/qrcode.svg"));
        $qrcode = base64_encode(file_get_contents(public_path("/uploads/$nif/amm_".$amm->id."/qrcode.svg")));

        ini_set("memory_limit", "2048M");
        $pdf = PDF::loadView('pages.traitement-amm.amm',
            compact('amm', 'image', 'chef', 'dir', 'dg', 'qrcode', 'suivi',
                'prescriptions', 'agent', 'filigrane'))
            ->setPaper('A4', 'portrait');

        $filename = "DOC_AMM_".$amm->getNumDemande().".pdf";
        //return $pdf->download($filename);
        return $pdf->stream($filename, array("Attachment" => false));
    }

    public function dwlanx($slug) {

        $amm = Amms::where('slug', '=', $slug)->firstOrFail();
        $prescriptions = PrescriptionAmm::where('idamm', '=', $amm->id)->get();

        $image = base64_encode(file_get_contents(public_path('/storage/pdf/head_anx_amm.png')));

        $agent = base64_encode(file_get_contents(public_path('/storage/pdf/agent.png')));
        $chef = base64_encode(file_get_contents(public_path('/storage/pdf/chef.png')));
        $dir = base64_encode(file_get_contents(public_path('/storage/pdf/dir.png')));
        $dg = base64_encode(file_get_contents(public_path('/storage/pdf/dg.png')));
        $filigrane = base64_encode(file_get_contents(public_path('/storage/pdf/filigrane.png')));

        $nif = $amm->getContribuable->nif;
        Qrcode::size(100)->generate(url('/verify-doc/AMM/'.$amm->slug), public_path("/uploads/$nif/amm_".$amm->id."/qrcode.svg"));
        $qrcode = base64_encode(file_get_contents(public_path("/uploads/$nif/amm_".$amm->id."/qrcode.svg")));


        if ($amm->modetransport == 'Aérien') {
            $infos_voyage = VolAmm::where('idamm', '=', $amm->id)->get();
        }
        else if ($amm->modetransport == 'Terrestre') {
            $infos_voyage = VehiculeAmm::where('idamm', '=', $amm->id)->get();
        }
        else {
            $infos_voyage = ConteneurAmm::where('idamm', '=', $amm->id)->get();
        }

        $produits_amm = ProduitAmms::where('idamm', '=', $amm->id)->get();
        ini_set("memory_limit", "2048M");

        $pdf = PDF::loadView('pages.traitement-amm.annexe',
            compact('amm', 'image', 'agent', 'chef', 'dir', 'dg', 'qrcode',
                'prescriptions', 'infos_voyage', 'produits_amm', 'filigrane'))
            ->setPaper('A4', 'portrait');;

        $filename = "DOC_ANNEXE_AMM_".$amm->getNumDemande().".pdf";
        //return $pdf->download($filename);
        return $pdf->stream($filename, array("Attachment" => false));
    }

    public function dwlrpt($slug) {

        $amm = Amms::where('slug', '=', $slug)->firstOrFail();

        $inspection = InspectionAmm::where('idamm', '=', $amm->id)->firstOrFail();
        $lignes_inspections_produits = LigneInspectionAmm::where('idinspectionamm', '=', $inspection->id)->get();
        $lignes_inspections_conteneurs = LigneInspectionConteneurAmm::where('idinspectionamm', '=', $inspection->id)->get();

        $prescriptions = PrescriptionAmm::where('idamm', '=', $amm->id)->get();
        $user = User::find($inspection->iduser);

        $image = base64_encode(file_get_contents(public_path('/storage/pdf/head_rpt_amm.png')));

        $nif = $amm->getContribuable->nif;
        Qrcode::size(100)->generate(url('/verify-doc/AMM/'.$amm->slug), public_path("/uploads/$nif/amm_".$amm->id."/qrcode.svg"));
        $qrcode = base64_encode(file_get_contents(public_path("/uploads/$nif/amm_".$amm->id."/qrcode.svg")));

        $agent = base64_encode(file_get_contents(public_path('/storage/pdf/agent.png')));
        $filigrane = base64_encode(file_get_contents(public_path('/storage/pdf/filigrane.png')));
        ini_set("memory_limit", "2048M");

        $pdf = PDF::loadView('pages.traitement-amm.rpt',
                    compact('amm', 'image', 'agent', 'inspection', 'qrcode',
                        'lignes_inspections_produits', 'lignes_inspections_conteneurs', 'user',
                        'prescriptions', 'filigrane'))
            ->setPaper('A4', 'portrait');;

        $filename = "DOC_ANNEXE_AMM_".$amm->getNumDemande().".pdf";
        //return $pdf->download($filename);
        return $pdf->stream($filename, array("Attachment" => false));
    }

}
