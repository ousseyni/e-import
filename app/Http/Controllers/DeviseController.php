<?php

namespace App\Http\Controllers;

use App\DeviseEtrangere;
use Illuminate\Http\Request;

class DeviseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $devises = DeviseEtrangere::all();
        return view('pages.devises.index', compact('devises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.devises.create');
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
            'libelle' => 'required|max:100'
        ]);
        $show = DeviseEtrangere::create([
            'code' => $request->code,
            'libelle' => $request->libelle,
            'taux' => 0
        ]);

        return redirect('/devises')->with('success', 'Devise enregistrée avec succès');
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
        $devise = DeviseEtrangere::where('id', '=', $id)->firstOrFail();
        return view('pages.devises.edit', compact('devise'));
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
            'code' => 'required|max:10',
            'libelle' => 'required|max:100'
        ]);
        DeviseEtrangere::where('id', '=', $id)->update($validatedData);

        return redirect('/devises')->with('success', 'Devise modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $devise = DeviseEtrangere::where('id', '=', $id)->firstOrFail();
        $devise->delete();

        return redirect('/devises')->with('success', 'Devise supprimée avec succès');
    }
}
