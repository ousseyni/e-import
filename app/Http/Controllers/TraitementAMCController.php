<?php

namespace App\Http\Controllers;

use App\AffectationAmc;
use App\Amcs;
use App\CategorieProduit;
use App\ConteneurAmc;
use App\Contribuables;
use App\DeviseEtrangere;
use App\EtatDemande;
use App\ModeTransport;
use App\OrdreRecetteAmc;
use App\Pays;
use App\PrescriptionAmc;
use App\Prescriptions;
use App\ProduitAmcs;
use App\Produits;
use App\SuiviAmcs;
use App\VehiculeAmc;
use App\VolAmc;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TraitementAMCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function etude()
    {
        $etat = array(1, 2, 3, 4, 998, 999, 9991);
        $demandes_etudes = Amcs::whereIn('etat', $etat)->paginate(10);

        return view('pages.traitement-amc.etude', compact('demandes_etudes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function valide()
    {
        $etat = array(5, 6, 7, 8, 9);
        $demandes_etudes = Amcs::whereIn('etat', $etat)->paginate(10);

        return view('pages.traitement-amc.valide', compact('demandes_etudes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function traite()
    {
        $etat = array(10);
        $demandes_etudes = Amcs::whereIn('etat', $etat)->paginate(10);

        return view('pages.traitement-amc.traite', compact('demandes_etudes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function state()
    {
        $demandes_etudes = Amcs::paginate(10);

        return view('pages.traitement-amc.state', compact('demandes_etudes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function trace($slug)
    {
        $amc = Amcs::where('slug', '=', $slug)->firstOrFail();
        $traces = SuiviAmcs::where('idamc', '=', $amc->id)->orderBy('created_at', 'DESC')->get();
        $tab_color = array('primary', 'success', 'info', 'warning', 'danger', 'danger');

        return view('pages.traitement-amc.trace',
            compact('amc', 'traces', 'tab_color'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function rapport($slug)
    {
        $amc = Amcs::where('slug', '=', $slug)->firstOrFail();

        $pays_pr = Pays::orderBy('libelle', 'ASC')->get();

        $categorie_produits = CategorieProduit::where('type', '=', 'AMC')->get();
        $produits = Produits::where('type', '=', 'AMC')->get();
        $pays_or = Pays::orderBy('libelle', 'ASC')->get();

        $mode_t = ModeTransport::all();

        $nif = $amc->getContribuable->nif;
        $contribuable = Contribuables::where('nif', '=', $nif)->firstOrFail();

        $tab_devise = DeviseEtrangere::orderBy('code', 'ASC')->get();

        return view('pages.traitement-amc.rapport',
            compact('pays_pr', 'contribuable', 'produits', 'mode_t',
                'pays_or', 'categorie_produits', 'tab_devise'));
    }


    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function traitement($slug)
    {
        $amc = Amcs::where('slug', '=', $slug)->firstOrFail();

        $etat_demande = EtatDemande::where('etat_actuel', '=', $amc->etat)->firstOrFail();
        $tab_suivant = array();
        if ($etat_demande->etat_suivant != '') {
            $etat_suivant = explode('-', $etat_demande->etat_suivant);
            foreach ($etat_suivant as $suivant) {
                $tab_suivant[] = EtatDemande::where('etat_actuel', '=', $suivant)->firstOrFail();
            }
        }

        //dd($tab_suivant);
        $users = User::where('profilid', '!=', 2)->get();

        $precriptions = Prescriptions::all();

        $odr = "";
        if ($amc->etat >= 6 && $amc->etat != 998 && $amc->etat != 999) {
            $odr = OrdreRecetteAmc::where('idamc', '=', $amc->id)->firstOrFail();
        }

        return view('pages.traitement-amc.traitement',
            compact('amc', 'users', 'tab_suivant', 'precriptions', 'odr'));
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
        $amc = Amcs::where('slug', '=', $request->slug)->firstOrFail();
        $action = $request->traitement_demande;

        if ($action == "affecter_demande") {
            $list_user = $request->affecter_demande;
            //dd($list_user);

            foreach ($list_user as $userid) {
                AffectationAmc::create([
                    'est_traite' => false,
                    'idamc' => $amc->id,
                    'iduser' => $userid,
                    'comments' => "Transmission aux agents - étude à effectuer",
                ]);
            }

            SuiviAmcs::create([
                'idamc' => $amc->id,
                'etat' => 2,
                'iduser' => Auth::id(),
                'comments' => "Transmission aux agents - étude à effectuer",
            ]);

            $amc->etat = 2;
        }
        else {
            $new_etat = $request->traiter_demande;
            $old_etat = $request->old_etat;

            //Eregistrement des prescriptions ou avis effectuées
            if ($new_etat == 3) {
                $prescriptions = $request->prescriptions;
                $comments = $request->comments_avis;
                foreach ($prescriptions as $prescription) {
                    PrescriptionAmc::create([
                        'dateprpt' => date('Y-m-d'),
                        'comments' => $comments,
                        'iduser' => Auth::id(),
                        'idamc' => $amc->id,
                        'idprescription' => $prescription,
                    ]);
                }
            }

            //Génération d'un ODR
            if ($new_etat == 6) {

                OrdreRecetteAmc::create([
                    'exercice' => date('Y'),
                    'date_emission' => date('Y-m-d'),
                    'quittance' => "",
                    'est_paye' => false,
                    'idamc' => $amc->id
                ]);
            }

            //Enregistrement de la fiche de crtl renseignée
            /*if ($old_etat == 4) {
                $usager_folder = public_path('uploads/'.$amc->getContribuable->nif.'/amc_'.$amc->id);
                if (!is_dir($usager_folder)) {
                    mkdir($usager_folder, 0777, true);
                }

                $fiche_crtl = 'fiche_crtl_renseignee.'.$request->fiche_crtl->extension();
                $request->fiche_crtl->move($usager_folder, $fiche_crtl);
                DocumentAmcs::create([
                    'libelle' => 'Fiche de contrôle renseignée',
                    'idamc' => $amc->id,
                    'pj' => $fiche_crtl
                ]);

                $amc->totalpen = $request->totalpen;
                $amc->totalglobal += $request->totalpen;
                $amc->save();
            }*/

            $etat = EtatDemande::where('id', '=', $new_etat)->firstOrFail();
            $comments = $etat->libelle_dgcc;

            if ($new_etat == 998 || $new_etat == 999) {
                $comments = $request->comments_traitement;
            }

            SuiviAmcs::create([
                'idamc' => $amc->id,
                'etat' => $new_etat,
                'iduser' => Auth::id(),
                'comments' => $comments,
            ]);

            $amc->etat = $new_etat;
        }
        $amc->save();

        $link = 'etude';
        if ($amc->etat >= 5 && $amc->etat <= 9) {
            $link = 'valide';
        }
        elseif ($amc->etat == 10) {
            $link = 'traite';
        }

        return redirect('/traitement-amc/'.$link)->with('success', "Traitement de la demande d'AMC enregistré avec succès");
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dwlord($slug) {

        $amc = Amcs::where('slug', '=', $slug)->firstOrFail();
        $odr = OrdreRecetteAmc::where('idamc', '=', $amc->id)->firstOrFail();

        $image = base64_encode(file_get_contents(public_path('/storage/img/gabon.jpg')));
        $filigrane = base64_encode(file_get_contents(public_path('/storage/img/filigrane.png')));
        $sign_odr = base64_encode(file_get_contents(public_path('/storage/img/sign_odr.png')));

        $pdf = PDF::loadView('pages.traitement-amc.odr',
            compact('amc', 'image', 'filigrane', 'odr', 'sign_odr'));

        $filename = "ORD_AMC_".$amc->getNumDemande().".pdf";
        //return $pdf->download($filename);
        return $pdf->stream($filename, array("Attachment" => false));
    }

    public function dwlamc($slug) {

        $amc = Amcs::where('slug', '=', $slug)->firstOrFail();
        $suivi = SuiviAmcs::where('idamc', '=', $amc->id)
            ->where('etat', '=', 10)->firstOrFail();

        $image = base64_encode(file_get_contents(public_path('/storage/pdf/back_amc.jpg')));

        $chef = base64_encode(file_get_contents(public_path('/storage/pdf/chef.png')));
        $dir = base64_encode(file_get_contents(public_path('/storage/pdf/dir.png')));
        $dg = base64_encode(file_get_contents(public_path('/storage/pdf/dg.png')));

        $nif = $amc->getContribuable->nif;
        Qrcode::size(100)->generate("https://www.akilischool.com", public_path("/uploads/$nif/amc_".$amc->id."/qrcode.svg"));
        $qrcode = base64_encode(file_get_contents(public_path("/uploads/$nif/amc_".$amc->id."/qrcode.svg")));

        $pdf = PDF::loadView('pages.traitement-amc.amc',
            compact('amc', 'image', 'chef', 'dir', 'dg', 'qrcode', 'suivi'))
            ->setPaper('A4', 'landscape');;

        $filename = "DOC_AMC_".$amc->getNumDemande().".pdf";
        //return $pdf->download($filename);
        return $pdf->stream($filename, array("Attachment" => false));
    }

    public function dwlanx($slug) {

        $amc = Amcs::where('slug', '=', $slug)->firstOrFail();
        $prescriptions = PrescriptionAmc::where('idamc', '=', $amc->id)->get();

        $image = base64_encode(file_get_contents(public_path('/storage/pdf/head_anx_amc.jpg')));

        $agent = base64_encode(file_get_contents(public_path('/storage/pdf/agent.png')));
        $chef = base64_encode(file_get_contents(public_path('/storage/pdf/chef.png')));
        $dir = base64_encode(file_get_contents(public_path('/storage/pdf/dir.png')));
        $dg = base64_encode(file_get_contents(public_path('/storage/pdf/dg.png')));

        if ($amc->modetransport == 'Aérien') {
            $infos_voyage = VolAmc::where('idamc', '=', $amc->id)->get();
        }
        else if ($amc->modetransport == 'Terrestre') {
            $infos_voyage = VehiculeAmc::where('idamc', '=', $amc->id)->get();
        }
        else {
            $infos_voyage = ConteneurAmc::where('idamc', '=', $amc->id)->get();
        }

        $produits_amc = ProduitAmcs::where('idamc', '=', $amc->id)->get();

        $pdf = PDF::loadView('pages.traitement-amc.annexe',
            compact('amc', 'image', 'agent', 'chef', 'dir', 'dg',
                'prescriptions', 'infos_voyage', 'produits_amc'))
            ->setPaper('A4', 'portrait');;

        $filename = "DOC_ANNEXE_AMC_".$amc->getNumDemande().".pdf";
        //return $pdf->download($filename);
        return $pdf->stream($filename, array("Attachment" => false));
    }
}
