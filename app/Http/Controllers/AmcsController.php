<?php

namespace App\Http\Controllers;

use App\Amcs;
use App\CategorieProduit;
use App\ConteneurAmc;
use App\Contribuables;
use App\DeviseEtrangere;
use App\DocumentAmcs;
use App\ModeTransport;
use App\Pays;
use App\ProduitAmcs;
use App\Produits;
use App\SuiviAmcs;
use App\VehiculeAmc;
use App\VolAmc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmcsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $amcs = Amcs::all();
        return view('pages.amcs.index', compact('amcs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $pays_pr = Pays::orderBy('libelle', 'ASC')->get();

        $categorie_produits = CategorieProduit::where('type', '=', 'AMC')->get();
        $produits = Produits::where('type', '=', 'AMC')->get();
        $pays_or = Pays::orderBy('libelle', 'ASC')->get();

        $mode_t = ModeTransport::all();

        $nif = Auth::user()->login;
        $contribuable = Contribuables::where('nif', '=', $nif)->firstOrFail();

        $tab_devise = DeviseEtrangere::orderBy('code', 'ASC')->get();

        return view('pages.amcs.create',
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
            'pj4' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',*/
        ]);

        $show = Amcs::create($validatedData);
        $contribuable = Contribuables::where('id', '=', $validatedData['idcontribuable'])->firstOrFail();

        $usager_folder = public_path('uploads/'.$contribuable->nif.'/amc_'.$show->id);
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

            DocumentAmcs::create([
                'libelle' => 'Facture Fournisseur '.$i,
                'idamc' => $show->id,
                'pj' => $name
            ]);
        }

        $certificat_sanitaire = 'certificat_sanitaire.'.$request->pj2->extension();
        $request->pj2->move($usager_folder, $certificat_sanitaire);
        DocumentAmcs::create([
            'libelle' => 'Certificat sanitaire',
            'idamc' => $show->id,
            'pj' => $certificat_sanitaire
        ]);

        $cnt = 'cnt_lta_lv.'.$request->pj3->extension();
        $request->pj3->move($usager_folder, $cnt);
        DocumentAmcs::create([
            'libelle' => 'CNT/LTA/LV',
            'idamc' => $show->id,
            'pj' => $cnt
        ]);

        $certificat_origine = 'certificat_origine.'.$request->pj4->extension();
        $request->pj4->move($usager_folder, $certificat_origine);
        DocumentAmcs::create([
            'libelle' => "Certificat d'origine",
            'idamc' => $show->id,
            'pj' => $certificat_origine
        ]);

        if($request->hasFile('pj6')) {
            $ail = 'ail.'.$request->pj6->extension();
            $request->pj6->move($usager_folder, $ail);
            DocumentAmcs::create([
                'libelle' => "Autorisation Spéciale des Lubrifiants",
                'idamc' => $show->id,
                'pj' => $ail
            ]);
        }

        if($request->hasFile('pj7')) {
            $asi = 'asi.'.$request->pj7->extension();
            $request->pj7->move($usager_folder, $asi);
            DocumentAmcs::create([
                'libelle' => "Autorisation Spéciale d'Importation",
                'idamc' => $show->id,
                'pj' => $asi
            ]);
        }

        if($request->hasFile('pj8')) {
            $asipr = 'asipr.'.$request->pj8->extension();
            $request->pj8->move($usager_folder, $asipr);
            DocumentAmcs::create([
                'libelle' => "Autorisation Spéciale d'Importation des produits réglementés (SAO & GES)",
                'idamc' => $show->id,
                'pj' => $asipr
            ]);
        }

        if($request->hasFile('pj9')) {
            $ldusr = 'ldusr.'.$request->pj9->extension();
            $request->pj9->move($usager_folder, $ldusr);
            DocumentAmcs::create([
                'libelle' => "licence de détention/utilisation des substances réglementées",
                'idamc' => $show->id,
                'pj' => $ldusr
            ]);
        }

        if($request->hasFile('pj10')) {
            $cf = 'ldusr.'.$request->pj10->extension();
            $request->pj10->move($usager_folder, $cf);
            DocumentAmcs::create([
                'libelle' => "Certificat de fumigation (riz & friperie)",
                'idamc' => $show->id,
                'pj' => $cf
            ]);
        }

        if($request->hasFile('pj11')) {
            $bietc = 'bietc.'.$request->pj10->extension();
            $request->pj10->move($usager_folder, $bietc);
            DocumentAmcs::create([
                'libelle' => "Bordereau d'Identification Electronique de Traçabilité des Cargaisons",
                'idamc' => $show->id,
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

            ProduitAmcs::create([
                'idamc' => $show->id,
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
            VolAmc::create([
                'idamc' => $show->id,
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

                ConteneurAmc::create([
                    'idamc' => $show->id,
                    'nomnavire' => $nomnavire,
                    'numvoyage' => $numvoyagem,
                    'numbietc' => $numbietc,
                    'numconteneur' => $numconteneur,
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
                $numconteneurt = $data['numconteneurt'];

                VehiculeAmc::create([
                    'idamc' => $show->id,
                    'numlvi' => $numlvi,
                    'numvehicule' => $numvehicule,
                    'numconteneur' => $numconteneurt,
                ]);
            }
        }

        SuiviAmcs::create([
            'idamc' => $show->id,
            'etat' => 1,
            'iduser' => Auth::id(),
            'comments' => "Nouvelle demande soumise à la DGCC",
        ]);

        return redirect('/amc')->with('success', "Demande d'Autorisation de Mise en Consommation enregistrée avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($slug)
    {
        $amc = Amcs::where('slug', '=', $slug)->firstOrFail();
        $doc_amcs = DocumentAmcs::where('idamc', '=', $amc->id)->get();
        return view('pages.amcs.show', compact('amc', 'doc_amcs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($slug)
    {
        $amc = Amcs::where('slug', '=', $slug)->firstOrFail();
        return view('pages.amcs.edit', compact('amc'));

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
            'totalamc' =>'numeric',
            'totalpen' =>'numeric',
            'observation' => 'max:100',
            'totalpoids' =>'numeric',
            'valeurcaf' =>'numeric',
            'consoservice' =>'numeric',
            'idcontribuable' =>'required|numeric',
        ]);
        //Amms::whereId($id)->update($validatedData);
        Amcs::where('slug', '=', $slug)->update($validatedData);

        return redirect('/amc')->with('success', 'AMC modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($slug)
    {
        $amc = Amcs::where('slug', '=', $slug)->firstOrFail();
        $amc->delete();

        return redirect('/amc')->with('success', 'Demande de AMC supprimée avec succès');
    }
}
