<?php

namespace App\Http\Controllers;

use App\Activite;
use App\Contribuables;
use App\SousActivite;
use App\TypeContribuables;
use App\User;
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
        //$contribuables = Contribuables::all();
        $contribuables = Contribuables::paginate(10);
        return view('pages.contribuables.index', compact('contribuables'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $typeContribuables = TypeContribuables::all(['id', 'libelle']);
        $activite = Activite::all();
        $sousactivite = SousActivite::all();
        return view('pages.contribuables.create',
            compact('typeContribuables', 'activite', 'sousactivite'));
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
            'nif' => 'required|max:10',
            'typecontribuableid' =>'numeric',
            'raisonsociale' => 'required|max:100',
            'siegesocial' => 'max:100',
            'bp' => 'max:100',
            'tel' => 'required|max:100',
            'rccm' => 'required|max:100',
            'numagrement' => 'max:50',
            'numcartecomm' => 'max:50',
            'nomprenom' => 'required|max:200',
            'email' => 'required|max:100',
            'activiteid' => 'required',
            'sousactiviteid' => 'required',
        ]);

        //dd($validatedData);
        Contribuables::updateOrCreate(
            ['nif' => $validatedData['nif']],
            [
                'typecontribuableid' => $validatedData['typecontribuableid'],
                'raisonsociale' => $validatedData['raisonsociale'],
                'siegesocial' => $validatedData['siegesocial'],
                'bp' => $validatedData['bp'],
                'tel' => $validatedData['tel'],
                'rccm' => $validatedData['rccm'],
                'numagrement' => $validatedData['numagrement'],
                'numcartecomm' => $validatedData['numcartecomm'],
                'nomprenom' => $validatedData['nomprenom'],
                'email' => $validatedData['email'],
                'activiteid' => $validatedData['activiteid'],
                'sousactiviteid' => $validatedData['sousactiviteid'],
            ]
        );

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
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($slug)
    {
        $contribuable = Contribuables::where('slug', '=', $slug)->firstOrFail();
        $typeContribuables = TypeContribuables::all(['id', 'libelle']);

        $activite = Activite::all();
        $sousactivite = SousActivite::all();

        return view('pages.contribuables.edit',
            compact('contribuable', 'typeContribuables', 'activite', 'sousactivite'));
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
            'nif' => 'required|max:10',
            'typecontribuableid' =>'numeric',
            'raisonsociale' => 'required|max:100',
            'siegesocial' => 'max:100',
            'bp' => 'max:100',
            'tel' => 'required|max:100',
            'rccm' => 'required|max:100',
            'numagrement' => 'max:50',
            'numcartecomm' => 'max:50',
            'nomprenom' => 'required|max:200',
            'email' => 'required|max:100',
            'activiteid' => 'required',
            'sousactiviteid' => 'required',
        ]);

        //dd($validatedData);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getcontribuable(Request $request)
    {
        $where = array('nif' => $request->nif);
        $contribuable  = Contribuables::where($where)->first();
        $type = ($contribuable && !is_null($contribuable->typecontribuableid)  ? $contribuable->getTypeContribuables->libelle : "Non défini");
        $nb  = Contribuables::where($where)->count();

        return response()->json(
            ['nb'=>$nb, 'data'=>$contribuable, 'type'=>$type]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getuser(Request $request)
    {
        /*$user  = User::where('login', '=', $request->nif)->first();

        //dd($user);

        $contribuable = null;
        $isuser = false;
        $where = array('nif' => $request->nif);
        if ($user) {
            $isuser = true;
            $contribuable  = Contribuables::where($where)->first();
        }
        $type = ($contribuable && !is_null($contribuable->typecontribuableid)  ? $contribuable->getTypeContribuables->libelle : "Non défini");
        $nb  = Contribuables::where($where)->count();
        return response()->json(
            ['nb'=>0,
             'data'=>$user,
             'type'=>null,
             'isuser'=>0,
             'user'=>0,
            ]
        );*/

        $where = array('nif' => $request->nif);
        $contribuable  = Contribuables::where($where)->first();
        $type = ($contribuable && !is_null($contribuable->typecontribuableid)  ? $contribuable->getTypeContribuables->libelle : "Non défini");
        $nb  = Contribuables::where($where)->count();

        return response()->json(
            ['nb'=>$nb, 'data'=>$contribuable, 'type'=>$type]
        );

    }
}
