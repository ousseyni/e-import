<?php

namespace App\Http\Controllers;

use App\Contribuables;
use App\DemandeComptes;
use App\Mail\MailTemplates;
use App\TypeContribuables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DemandeComptesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //$demandecomptes = DemandeComptes::all();
        $typeContribuables = TypeContribuables::all(['id', 'libelle']);
        return view('pages.demande-comptes.index', compact('typeContribuables'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function list()
    {
        $demandecomptes = DemandeComptes::paginate(10);
        return view('pages.demande-comptes.list', compact('demandecomptes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'tel' => 'required|max:100',
            'email' => 'required|max:100',
            'pj' => 'required|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);


        $fileName = $validatedData['nif'].'.'.$request->pj->extension();
        $request->pj->move(public_path('uploads'), $fileName);
        $etat = 0;

        //dd($validatedData);

        DemandeComptes::updateOrCreate(
            ['nif' => $validatedData['nif']],
            [
                'typecontribuableid' => $validatedData['typecontribuableid'],
                'raisonsociale' => $validatedData['raisonsociale'],
                'tel' => $validatedData['tel'],
                'email' => $validatedData['email'],
                'pj' => $fileName,
                'etat' => $etat
            ]
        );

        $details = [
            'title' => 'Création de compte e-services DGCC',
            'body' => "Votre demande de création de compte a été enregistré avec succès.
            Vous recevrez par mail, très prochainement, le lien d'activation de compte."
        ];

        Mail::to($validatedData['email'])->send(new MailTemplates($details));

        return redirect('/demande-comptes')->with('success', 'Votre demande de création de compte a été envoyée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show()
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
        $demande = DemandeComptes::where('slug', '=', $slug)->firstOrFail();
        $typeContribuables = TypeContribuables::all(['id', 'libelle']);

        return view('pages.demande-comptes.edit', compact('demande', 'typeContribuables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $slug
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
            'email' => 'required|max:100'
        ]);

        //dd($validatedData);
        $etat = 1;
        $demandes = DemandeComptes::where('slug', '=', $slug)->firstOrFail();
        $fileName = $demandes->pj;

        DemandeComptes::updateOrCreate(
            ['nif' => $demandes->nif],
            [
                'typecontribuableid' => $validatedData['typecontribuableid'],
                'raisonsociale' => $validatedData['raisonsociale'],
                'siegesocial' => $validatedData['siegesocial'],
                'tel' => $validatedData['tel'],
                'email' => $validatedData['email'],
                'etat' => $etat
            ]
        );

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
                'pj' => $fileName
            ]
        );

        return redirect('/demande-comptes/list')->with('success', 'Demande de création de compte validée avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($slug)
    {
        $demandes = DemandeComptes::where('slug', '=', $slug)->firstOrFail();

        $details = [
            'title' => 'Rejet de demande de compte e-services DGCC',
            'body' => "Votre demande de création de compte a été rejetée par les agents de la DGCC pour
                       des raisons de non conformité de votre dossier. Nous vous prions de vous rendre
                       à la DGCC en cas de reclamations."
        ];

        Mail::to($demandes->email)->send(new MailTemplates($details));

        $demandes->delete();

        return redirect('/demande-comptes/list')->with('success', 'Demande de création de compte rejeté avec succès');
    }
}
