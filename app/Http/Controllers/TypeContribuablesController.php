<?php

namespace App\Http\Controllers;

use App\TypeContribuables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeContribuablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $typecontribuables = TypeContribuables::all();
        return view('pages.type-contribuables.index', compact('typecontribuables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.type-contribuables.create');
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
        ]);

        $show = TypeContribuables::create($validatedData);

        return redirect('/type-contribuables')->with('success', 'Type Contribuable enregistré avec succès');
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
        $typecontribuable = TypeContribuables::where('slug', '=', $slug)->firstOrFail();
        return view('pages.type-contribuables.edit', compact('typecontribuable'));
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
        ]);
        //TypeContribuables::whereId($id)->update($validatedData);
        TypeContribuables::where('slug', '=', $slug)->update($validatedData);

        return redirect('/type-contribuables')->with('success', 'Type contribuable modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($slug)
    {
        //$typecontribuable = TypeContribuables::findOrFail($id);
        $typecontribuable = TypeContribuables::where('slug', '=', $slug)->firstOrFail();
        $typecontribuable->delete();

        return redirect('/type-contribuables')->with('success', 'Type contribuable supprimé avec succès');
    }
}
