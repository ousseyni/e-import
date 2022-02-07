<?php

namespace App\Http\Controllers;

use App\CategorieProduit;
use Illuminate\Http\Request;

class CategorieProduitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $categorieproduits = CategorieProduit::all();

        return view('pages.categorie-produits.index', compact('categorieproduits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.categorie-produits.create');
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
            'libelle' => 'required|max:100',
            'montant' => 'required|numeric'
        ]);
        $show = CategorieProduit::create($validatedData);

        return redirect('/categorie-produits')->with('success', 'Categorie Produit enregistrée avec succès');

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($slug)
    {
        $categorieproduits = CategorieProduit::where('slug', '=', $slug)->firstOrFail();
        return view('pages.categorie-produits.edit', compact('categorieproduits'));

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
            'libelle' => 'required|max:100',
            'montant' => 'required|max:30'
        ]);
        //TypeContribuables::whereId($id)->update($validatedData);
        CategorieProduit::where('slug', '=', $slug)->update($validatedData);

        return redirect('/categorie-produits')->with('success', 'Catégorie produit modifiée avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($slug)
    {
        $categorieproduits = CategorieProduit::where('slug', '=', $slug)->firstOrFail();
        $categorieproduits->delete();

        return redirect('/categorie-produits')->with('success', 'Catégorie produit supprimée avec succès');

    }
}
