<?php

namespace App\Http\Controllers;

use App\AffectationAmm;
use App\Amms;
use App\CategorieProduit;
use App\ConteneurAmm;
use App\Contribuables;
use App\DeviseEtrangere;
use App\DocumentAmms;
use App\EtatDemande;
use App\ModeTransport;
use App\OrdreRecetteAmm;
use App\Pays;
use App\PrescriptionAmm;
use App\Prescriptions;
use App\ProduitAmms;
use App\Produits;
use App\SuiviAmms;
use App\User;
use App\VehiculeAmm;
use App\VolAmm;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TraitementAMMController extends Controller
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
        $demandes_etudes = Amms::whereIn('etat', $etat)->paginate(10);

        return view('pages.traitement-amm.etude', compact('demandes_etudes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function valide()
    {
        $etat = array(5, 6, 7, 8, 9);
        $demandes_etudes = Amms::whereIn('etat', $etat)->paginate(10);

        return view('pages.traitement-amm.valide', compact('demandes_etudes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function traite()
    {
        $etat = array(10);
        $demandes_etudes = Amms::whereIn('etat', $etat)->paginate(10);

        return view('pages.traitement-amm.traite', compact('demandes_etudes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function state()
    {
        $demandes_etudes = Amms::paginate(10);

        return view('pages.traitement-amm.state', compact('demandes_etudes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function trace($slug)
    {
        $amm = Amms::where('slug', '=', $slug)->firstOrFail();
        $traces = SuiviAmms::where('idamm', '=', $amm->id)->orderBy('created_at', 'DESC')->get();
        $tab_color = array('primary', 'success', 'info', 'warning', 'danger', 'danger');

        return view('pages.traitement-amm.trace',
            compact('amm', 'traces', 'tab_color'));
    }


    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function traitement($slug)
    {
        $amm = Amms::where('slug', '=', $slug)->firstOrFail();

        $etat_demande = EtatDemande::where('etat_actuel', '=', $amm->etat)->firstOrFail();
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
        if ($amm->etat >= 6 && $amm->etat != 998 && $amm->etat != 999) {
            $odr = OrdreRecetteAmm::where('idamm', '=', $amm->id)->firstOrFail();
        }

        return view('pages.traitement-amm.traitement',
            compact('amm', 'users', 'tab_suivant', 'precriptions', 'odr'));
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
        $amm = Amms::where('slug', '=', $request->slug)->firstOrFail();
        $action = $request->traitement_demande;

        if ($action == "affecter_demande") {
            $list_user = $request->affecter_demande;
            //dd($list_user);

            foreach ($list_user as $userid) {
                AffectationAmm::create([
                    'est_traite' => false,
                    'idamm' => $amm->id,
                    'iduser' => $userid,
                    'comments' => "Transmission aux agents - étude à effectuer",
                ]);
            }

            SuiviAmms::create([
                'idamm' => $amm->id,
                'etat' => 2,
                'iduser' => Auth::id(),
                'comments' => "Transmission aux agents - étude à effectuer",
            ]);

            $amm->etat = 2;
        }
        else {
            $new_etat = $request->traiter_demande;
            $old_etat = $request->old_etat;

            //Eregistrement des prescriptions ou avis effectuées
            if ($new_etat == 3) {
                $prescriptions = $request->prescriptions;
                $comments = $request->comments_avis;
                foreach ($prescriptions as $prescription) {
                    PrescriptionAmm::create([
                        'dateprpt' => date('Y-m-d'),
                        'comments' => $comments,
                        'iduser' => Auth::id(),
                        'idamm' => $amm->id,
                        'idprescription' => $prescription,
                    ]);
                }
            }

            //Génération d'un ODR
            if ($new_etat == 6) {

                OrdreRecetteAmm::create([
                    'exercice' => date('Y'),
                    'date_emission' => date('Y-m-d'),
                    'quittance' => "",
                    'est_paye' => false,
                    'idamm' => $amm->id
                ]);
            }

            //Enregistrement de la fiche de crtl renseignée
            /*if ($old_etat == 4) {
                $usager_folder = public_path('uploads/'.$amm->getContribuable->nif.'/amm_'.$amm->id);
                if (!is_dir($usager_folder)) {
                    mkdir($usager_folder, 0777, true);
                }

                $fiche_crtl = 'fiche_crtl_renseignee.'.$request->fiche_crtl->extension();
                $request->fiche_crtl->move($usager_folder, $fiche_crtl);
                DocumentAmms::create([
                    'libelle' => 'Fiche de contrôle renseignée',
                    'idamm' => $amm->id,
                    'pj' => $fiche_crtl
                ]);

                $amm->totalpen = $request->totalpen;
                $amm->totalglobal += $request->totalpen;
                $amm->save();
            }*/

            $etat = EtatDemande::where('id', '=', $new_etat)->firstOrFail();
            $comments = $etat->libelle_dgcc;

            if ($new_etat == 998 || $new_etat == 999) {
                $comments = $request->comments_traitement;
            }

            SuiviAmms::create([
                'idamm' => $amm->id,
                'etat' => $new_etat,
                'iduser' => Auth::id(),
                'comments' => $comments,
            ]);

            $amm->etat = $new_etat;
        }
        $amm->save();

        $link = 'etude';
        if ($amm->etat >= 5 && $amm->etat <= 9) {
            $link = 'valide';
        }
        elseif ($amm->etat == 10) {
            $link = 'traite';
        }

        return redirect('/traitement-amm/'.$link)->with('success', "Traitement de la demande d'AMM enregistré avec succès");
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

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function rapport($slug)
    {
        $amm = Amms::where('slug', '=', $slug)->firstOrFail();

        $pays_pr = Pays::orderBy('libelle', 'ASC')->get();

        $categorie_produits = CategorieProduit::where('type', '=', 'AMC')->get();
        $produits = Produits::where('type', '=', 'AMC')->get();
        $pays_or = Pays::orderBy('libelle', 'ASC')->get();

        $mode_t = ModeTransport::all();

        $nif = $amm->getContribuable->nif;
        $contribuable = Contribuables::where('nif', '=', $nif)->firstOrFail();

        $tab_devise = DeviseEtrangere::orderBy('code', 'ASC')->get();

        return view('pages.traitement-amm.rapport',
            compact('pays_pr', 'contribuable', 'produits', 'mode_t',
                'pays_or', 'categorie_produits', 'tab_devise', 'amm'));
    }

    public function dwlord($slug) {

        $amm = Amms::where('slug', '=', $slug)->firstOrFail();
        $odr = OrdreRecetteAmm::where('idamm', '=', $amm->id)->firstOrFail();

        $image = base64_encode(file_get_contents(public_path('/storage/img/gabon.jpg')));
        $filigrane = base64_encode(file_get_contents(public_path('/storage/img/filigrane.png')));
        $sign_odr = base64_encode(file_get_contents(public_path('/storage/img/sign_odr.png')));

        $pdf = PDF::loadView('pages.traitement-amm.odr',
            compact('amm', 'image', 'filigrane', 'odr', 'sign_odr'));

        $filename = "ORD_AMM_".$amm->getNumDemande().".pdf";
        //return $pdf->download($filename);
        return $pdf->stream($filename, array("Attachment" => false));
    }

    public function dwlamm($slug) {

        $amm = Amms::where('slug', '=', $slug)->firstOrFail();
        $suivi = SuiviAmms::where('idamm', '=', $amm->id)
            ->where('etat', '=', 10)->firstOrFail();
        $prescriptions = PrescriptionAmm::where('idamm', '=', $amm->id)->get();

        $image = base64_encode(file_get_contents(public_path('/storage/pdf/back_amm.jpg')));

        $agent = base64_encode(file_get_contents(public_path('/storage/pdf/agent.png')));
        $chef = base64_encode(file_get_contents(public_path('/storage/pdf/chef.png')));
        $dir = base64_encode(file_get_contents(public_path('/storage/pdf/dir.png')));
        $dg = base64_encode(file_get_contents(public_path('/storage/pdf/dg.png')));

        $nif = $amm->getContribuable->nif;
        Qrcode::size(100)->generate(url('/verify-doc/AMM/'.$amm->slug), public_path("/uploads/$nif/amm_".$amm->id."/qrcode.svg"));
        $qrcode = base64_encode(file_get_contents(public_path("/uploads/$nif/amm_".$amm->id."/qrcode.svg")));

        $pdf = PDF::loadView('pages.traitement-amm.amm',
            compact('amm', 'image', 'chef', 'dir', 'dg', 'qrcode', 'suivi',
                'prescriptions', 'agent'))
            ->setPaper('A4', 'portrait');

        $filename = "DOC_AMM_".$amm->getNumDemande().".pdf";
        //return $pdf->download($filename);
        return $pdf->stream($filename, array("Attachment" => false));
    }

    public function dwlanx($slug) {

        $amm = Amms::where('slug', '=', $slug)->firstOrFail();
        $prescriptions = PrescriptionAmm::where('idamm', '=', $amm->id)->get();

        $image = base64_encode(file_get_contents(public_path('/storage/pdf/head_anx_amm.jpg')));

        $agent = base64_encode(file_get_contents(public_path('/storage/pdf/agent.png')));
        $chef = base64_encode(file_get_contents(public_path('/storage/pdf/chef.png')));
        $dir = base64_encode(file_get_contents(public_path('/storage/pdf/dir.png')));
        $dg = base64_encode(file_get_contents(public_path('/storage/pdf/dg.png')));

        if ($amm->modetransport == 'Aérien') {
            $infos_voyage = VolAmm::where('idamm', '=', $amm->id)->get();
        }
        else if ($amm->modetransport == 'Terrestre') {
            $infos_voyage = VehiculeAmm::where('idamm', '=', $amm->id)->get();
        }
        else {
            $infos_voyage = ConteneurAmm::where('idamm', '=', $amm->id)->get();
        }

        $produits_amm = ProduitAmms::where('idamm', '=', $amm->id)->get();

        $pdf = PDF::loadView('pages.traitement-amm.annexe',
                    compact('amm', 'image', 'agent', 'chef', 'dir', 'dg',
                    'prescriptions', 'infos_voyage', 'produits_amm'))
                    ->setPaper('A4', 'portrait');;

        $filename = "DOC_ANNEXE_AMM_".$amm->getNumDemande().".pdf";
        //return $pdf->download($filename);
        return $pdf->stream($filename, array("Attachment" => false));
    }

}
