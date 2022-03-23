<?php

namespace App\Http\Controllers;

use App\Amms;
use App\CategorieProduit;
use App\Contribuables;
use App\DemandeComptes;
use App\DocumentAmms;
use App\ModeTransport;
use App\Pays;
use App\ProduitAmms;
use App\Produits;
use App\SuiviAmms;
use App\TypeContribuables;
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

        return view('pages.amms.create',
            compact('pays_pr', 'contribuable', 'produits', 'mode_t', 'pays_or', 'categorie_produits'));
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
            'numfact' => 'required|max:20',
            'datefact' => 'date',
            'paysprov' => 'max:200',
            'modetransport' => 'max:150',
            'fournisseur' => 'max:50',
            'cieaerien' => 'max:200',
            'numvoyagea' => 'max:200',
            'nomnavire' => 'max:200',
            'numvoyagem' => 'max:200',
            'numvehicul' => 'max:200',
            'numvoyaget' => 'max:200',
            'numwagon' => 'max:200',
            'numvoyagef' => 'max:200',
            'numconteneur' => 'max:200',
            'numconnaissement' => 'max:200',
            'dateembarque' => 'date',
            'lieuembarque' => 'max:100',
            'datedebarque' => 'date',
            'lieudebarque' => 'max:100',
            'totalamm' =>'numeric',
            'totalpoids' =>'numeric',
            'valeurcaf' =>'numeric',
            'idcontribuable' =>'required|numeric',
            'pj1' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',
            'pj2' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',
            'pj3' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',
            'pj4' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',
            'pj5' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',
            'pj6' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',
            'pj7' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',
            'pj8' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',
            'pj9' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',
            'pj10' => 'required|mimes:pdf,jpg,jpeg,png|max:512000',
        ]);

        $show = Amms::create($validatedData);
        $contribuable = Contribuables::where('id', '=', $validatedData['idcontribuable'])->firstOrFail();

        $usager_folder = public_path('uploads/'.$contribuable->nif);
        if (!is_dir($usager_folder)) {
            mkdir($usager_folder, 0777, true);
        }

        //Sauvegarde des PJ
        $facture_fournisseur = 'facture_fournisseur.'.$request->pj1->extension();
        $request->pj1->move($usager_folder, $facture_fournisseur);
        DocumentAmms::create([
            'libelle' => 'Facture Fournisseur',
            'idamm' => $show->id,
            'pj' => $facture_fournisseur
        ]);

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
            'pj' => $cnt
        ]);


        //Sauvegarde des produits associés à la demande
        if ($request->prodA !== null) {
            ProduitAmms::create([
                'idamm' => $show->id,
                'idproduit' => $request->prodA,
                'paysorig' => $request->paysA,
                'poids' => $request->poidsA,
                'total' => $request->totalA
            ]);
        }

        if ($request->prodB !== null) {
            ProduitAmms::create([
                'idamm' => $show->id,
                'idproduit' => $request->prodB,
                'paysorig' => $request->paysB,
                'poids' => $request->poidsB,
                'total' => $request->totalB
            ]);
        }

        if ($request->prodC !== null) {
            ProduitAmms::create([
                'idamm' => $show->id,
                'idproduit' => $request->prodC,
                'paysorig' => $request->paysC,
                'poids' => $request->poidsC,
                'total' => $request->totalC
            ]);
        }

        if ($request->prodD !== null) {
            ProduitAmms::create([
                'idamm' => $show->id,
                'idproduit' => $request->prodD,
                'paysorig' => $request->paysD,
                'poids' => $request->poidsD,
                'total' => $request->totalD
            ]);
        }

        //dd($request->prodD);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($slug)
    {
        $amms = Amms::where('slug', '=', $slug)->firstOrFail();
        return view('pages.amms.edit', compact('amms'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
        $amms = Amms::where('slug', '=', $slug)->firstOrFail();
        $amms->delete();

        return redirect('/amms')->with('success', 'Demande de AMM supprimée avec succès');

    }

}
