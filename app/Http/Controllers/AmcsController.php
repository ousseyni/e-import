<?php

namespace App\Http\Controllers;

use App\Amcs;
use Illuminate\Http\Request;

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

        return view('pages.amcs.create');
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
        $show = Amcs::create($validatedData);

        return redirect('/amcs')->with('success', "Demande d'autorisation de mise en circulation enregistrée avec succès");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
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
        $amms = Amcs::where('slug', '=', $slug)->firstOrFail();
        return view('pages.amcs.edit', compact('amcs'));

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

        return redirect('/amcs')->with('success', 'AMC modifiée avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($slug)
    {
        $amcs = Amcs::where('slug', '=', $slug)->firstOrFail();
        $amcs->delete();

        return redirect('/amcs')->with('success', 'Demande de AMC supprimée avec succès');

    }
}
