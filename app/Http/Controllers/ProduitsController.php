<?php

namespace App\Http\Controllers;

use App\Amms;
use App\CategorieProduit;
use App\FraisDossier;
use App\Produits;
use Illuminate\Http\Request;

class ProduitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $produits = Produits::all();
        return view('pages.produits.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $categoriesAmc = CategorieProduit::where('type', '=', 'AMC')->get();
        $categoriesAmm = CategorieProduit::where('type', '=', 'AMM')->get();
        return view('pages.produits.create',
            compact('categoriesAmc', 'categoriesAmm'));
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
            'code' => 'required|max:10',
            'libelle' => 'required|max:100',
            'montant' => 'required|max:30',
            'categorie_produit_id' =>'numeric',
        ]);

        //dd($validatedData);
        //$show = Produits::create($validatedData);
        $categorie = CategorieProduit::find($request->categorie_produit_id);
        $show = Produits::create([
            'code'     => $request->code,
            'libelle'  => $request->libelle,
            'montant'  => $request->montant,
            'type'     => $categorie->type,
            'categorie_produit_id'     => $request->categorie_produit_id,
        ]);

        return redirect('/produits')->with('success', 'Produit enregistré avec succès');
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
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($slug)
    {
        $produit = Produits::where('slug', '=', $slug)->firstOrFail();
        $categoriesAmc = CategorieProduit::where('type', '=', 'AMC')->get();
        $categoriesAmm = CategorieProduit::where('type', '=', 'AMM')->get();

        return view('pages.produits.edit',
            compact('produit', 'categoriesAmc', 'categoriesAmm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'code' => 'required|max:10',
            'libelle' => 'required|max:100',
            'montant' => 'required|max:30',
            'categorie_produit_id' =>'numeric',
        ]);

        //dd($validatedData);
        //$show = Produits::create($validatedData);
        $categorie = CategorieProduit::find($request->categorie_produit_id);
        $show = Produits::where('slug', '=', $slug)->update([
            'code'     => $request->code,
            'libelle'  => $request->libelle,
            'montant'  => $request->montant,
            'type'     => $categorie->type,
            'categorie_produit_id'     => $request->categorie_produit_id,
        ]);

        return redirect('/produits')->with('success', 'Produit modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($slug)
    {
        $produit = Produits::where('slug', '=', $slug)->firstOrFail();
        $produit->delete();

        return redirect('/produits')->with('success', 'Produit supprimée avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getcategorie(Request $request)
    {
        $categorie  = CategorieProduit::find($request->categorieid);
        $montant = '';
        if ($categorie != null) {
            $montant = $categorie->montant;
        }
        return response()->json(
            ['montant' => $montant]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getprix(Request $request)
    {
        $produitA  = Produits::find($request->idA);
        $montantA = 0;
        if ($produitA != null) {
            $montantA = $produitA->montant;
        }

        $produitB  = Produits::find($request->idB);
        $montantB = 0;
        if ($produitB != null) {
            $montantB = $produitB->montant;
        }

        $produitC  = Produits::find($request->idC);
        $montantC = 0;
        if ($produitC != null) {
            $montantC = $produitC->montant;
        }

        $produitD  = Produits::find($request->idD);
        $montantD = 0;
        if ($produitD != null) {
            $montantD = $produitD->montant;
        }
        return response()->json([
            'montantA' => $montantA,
            'montantB' => $montantB,
            'montantC' => $montantC,
            'montantD' => $montantD,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_prix(Request $request)
    {
        $produit  = Produits::find($request->id);
        $montant = 0;
        if ($produit != null) {
            $montant = $produit->montant;
        }

        return response()->json([
            'montant' => $montant
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_frais_dossier(Request $request)
    {
        $frais_dossier = FraisDossier::where('designation', '=', $request->designation)->firstOrFail();
        $totalenr = 0;
        if ($frais_dossier != null) {
            $totalenr = $frais_dossier->valeur_int;
        }

        return response()->json([
            'totalenr' => $totalenr
        ]);
    }
}
