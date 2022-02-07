<?php

namespace App\Http\Controllers;

use App\Contribuables;
use Illuminate\Http\Request;

class ContribuablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $contribuables = Contribuables::all();

        return view('pages.contribuables.index', compact('contribuables'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {

        return view('pages.contribuables.create');
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
            'nif' => 'required|max:100',
            'raisonsocial' => 'max:100',
            'rccm' => 'max:100',
            'bp' => 'max:100',
            'tel' => 'max:100',
            'email' => 'max:100',
            'numagrement' => 'max:100',
            'numcartecomm' => 'max:100',
            'typecontribuableid' =>'required|numeric',
        ]);
        $show = Contribuables::create($validatedData);

        return redirect('/contribuables')->with('success', 'Contribuable enregistrée avec succès');

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
        $contribuables = Contribuables::where('slug', '=', $slug)->firstOrFail();
        return view('pages.contribuables.edit', compact('contribuables'));

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
            'nif' => 'required|max:100',
            'raisonsocial' => 'max:100',
            'rccm' => 'max:100',
            'bp' => 'max:100',
            'tel' => 'max:100',
            'email' => 'max:100',
            'numagrement' => 'max:100',
            'numcartecomm' => 'max:100',
            'typecontribuableid' => 'max:100',
        ]);
        //Contribuables::whereId($id)->update($validatedData);
        Contribuables::where('slug', '=', $slug)->update($validatedData);

        return redirect('/contribuables')->with('success', 'Contribuable modifié avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($slug)
    {
        $contribuables = Contribuables::where('slug', '=', $slug)->firstOrFail();
        $contribuables->delete();

        return redirect('/contribuables')->with('success', 'Contribuable supprimée avec succès');

    }

    public function getContribuableByNif($nif) {
        // get records from database
        $nb =Contribuables::where('nif', '=', $nif)->count();
        if ($nb == 1) {
            $arr['data'] = Contribuables::where('nif', $nif)->first();
            $arr['msg'] = "Contribuable disponible dans la base de données";
            $arr['nb'] = $nb;
        }
        else {
            $arr['data'] = nullOrEmptyString();
            $arr['msg'] = "Contribuable non disponible dans la base de données";
            $arr['nb'] = $nb;
        }

        echo json_encode($arr);
        exit;
    }
}
