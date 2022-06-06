<?php

namespace App\Http\Controllers;

use App\Prescriptions;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $prescriptions = Prescriptions::all();
        return view('pages.prescriptions.index', compact('prescriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.prescriptions.create');
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
        $show = Prescriptions::create([
            'code' => $request->code,
            'libelle' => $request->libelle,
        ]);

        return redirect('/prescriptions')->with('success', 'Prescription enregistrée avec succès');
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
        $prescription = Prescriptions::where('id', '=', $id)->firstOrFail();
        return view('pages.prescriptions.edit', compact('prescription'));
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
        Prescriptions::where('id', '=', $id)->update($validatedData);

        return redirect('/prescriptions')->with('success', 'Prescription modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prescription = Prescriptions::where('id', '=', $id)->firstOrFail();
        $prescription->delete();

        return redirect('/prescriptions')->with('success', 'Prescription supprimée avec succès');
    }
}
