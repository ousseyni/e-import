<?php

namespace App\Http\Controllers;

use App\Habilitation;
use App\Profils;
use Illuminate\Http\Request;

class ProfilsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $profils = Profils::all();
        return view('pages.profils.index', compact('profils'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $droits = Habilitation::all();
        return view('pages.profils.create', compact('droits'));
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
            'libelle' => 'required|max:100'
        ]);
        $profil = Profils::create($validatedData);

        $tab_droit = $request->droits;
        //dd($tab_droit);

        $droits = Habilitation::find($tab_droit);
        $profil->getHabilitations()->attach($droits);

        return redirect('/profils')->with('success', 'Profil enregistrée avec succès');
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
        $profil = Profils::where('slug', '=', $slug)->firstOrFail();
        $droits = Habilitation::all();
        $tab_habilitaion = $profil->get_droit_profil();
        return view('pages.profils.edit', compact('profil', 'droits', 'tab_habilitaion'));
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
            'libelle' => 'required|max:100'
        ]);
        Profils::where('slug', '=', $slug)->update($validatedData);
        $profil = Profils::where('slug', '=', $slug)->firstOrFail();

        $old_habilitations = Habilitation::where('profils_id', '=', $profil->id)->firstOrFail();
        foreach ($old_habilitations as $old) {
            $old->delete();
        }
        $tab_droit = $request->droits;
        //dd($tab_droit);
        $droits = Habilitation::find($tab_droit);
        $profil->getHabilitations()->attach($droits);

        return redirect('/profils')->with('success', 'Profil modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($slug)
    {
        $profil = Profils::where('slug', '=', $slug)->firstOrFail();
        $profil->delete();

        return redirect('/profils')->with('success', 'Profil supprimé avec succès');
    }
}
