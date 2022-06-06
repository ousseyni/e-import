<?php

namespace App\Http\Controllers;

use App\FraisDossier;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\FrameStub;

class FraisDossierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $frais = FraisDossier::all();
        return view('pages.frais-dossiers.index', compact('frais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.frais-dossiers.create');
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
            'designation' => 'required|max:10',
            'valeur_int' => 'required|max:100'
        ]);
        $show = FraisDossier::create([
            'designation' => $request->designation,
            'valeur_int' => $request->valeur_int
        ]);

        return redirect('/frais-dossiers')->with('success', 'Frais de dossiers enregistré avec succès');
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
    public function edit($id)
    {
        $frais = FraisDossier::where('id', '=', $id)->firstOrFail();
        return view('pages.frais-dossiers.edit', compact('frais'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'designation' => 'required|max:10',
            'valeur_int' => 'required|max:100'
        ]);

        FraisDossier::where('id', '=', $id)->update($validatedData);

        return redirect('/frais-dossiers')->with('success', 'Frais de dossiers modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $frais = FraisDossier::where('id', '=', $id)->firstOrFail();
        $frais->delete();

        return redirect('/frais-dossiers')->with('success', 'Frais de dossiers supprimé avec succès');
    }
}
