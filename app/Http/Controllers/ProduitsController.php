<?php

namespace App\Http\Controllers;

use App\Amms;
use App\CategorieProduit;
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
        $produits = Produits::paginate(10);
        return view('pages.produits.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $categories = CategorieProduit::all(['id', 'code', 'libelle']);
        return view('pages.produits.create', compact('categories'));
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
            'categorieid' =>'numeric',
        ]);

        //dd($validatedData);
        $show = Produits::create($validatedData);

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
        $categories = CategorieProduit::all(['id', 'code', 'libelle']);

        return view('pages.produits.edit', compact('produit', 'categories'));
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
            'categorieid' =>'numeric',
        ]);
        Produits::where('slug', '=', $slug)->update($validatedData);

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
}
