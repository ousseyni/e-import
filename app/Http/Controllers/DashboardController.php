<?php

namespace App\Http\Controllers;

use App\Amcs;
use App\Amms;
use App\Contribuables;
use App\ProduitAmcs;
use App\ProduitAmms;
use App\Produits;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function admin()
    {
        //$withRange = true;
        //$tab_societe = array($all_societe, $imp, $exp, $local);
        //return view('pages.dashboard.admin', compact('tab_societe', 'withRange'));
		ini_set('memory_limit', '256M');

        $debut = date('Y').'-01-01';
        $fin = date('Y-m-d');

        return redirect('/dashboard/admin/'.$debut.'/'.$fin);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function user()
    {
		ini_set('memory_limit', '256M');
        $debut = date('Y').'-01-01';
        $fin = date('Y-m-d');

        return redirect('/dashboard/user/'.$debut.'/'.$fin);
    }

    /**
     * Display the specified resource.
     *
     * @param  date  $date_debut,$date_fin
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function adminrange($date_debut, $date_fin)
    {
		ini_set('memory_limit', '256M');
        $all_societe = Contribuables::all()->count();
        $imp = Contribuables::where('typecontribuableid', '=', 1)->count();
        $exp = Contribuables::where('typecontribuableid', '=', 2)->count();
        $local = Contribuables::where('typecontribuableid', '=', 3)->count();

        $withRange = true;

        $tab_societe = array($all_societe, $imp, $exp, $local);

        $amcs = Amcs::whereBetween('created_at', [$date_debut, $date_fin])->count();

        $amcs_depot = DB::table('prescription_amcs')
                        ->distinct('idamc')
                        ->whereBetween('created_at', [$date_debut, $date_fin])
                        ->count('idamc');

        $amcs_depot_eff = DB::table('inspection_amcs')
            ->distinct('idamc')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count('idamc');

        $amcs_rejet = Amcs::whereIn('etat', [998, 999])
                        ->whereBetween('created_at', [$date_debut, $date_fin])
                        ->count();

        $amcs_sig = Amcs::where('etat','=', 10)
                        ->whereBetween('created_at', [$date_debut, $date_fin])
                        ->count();

        $amcs_caf = DB::table('amcs')
                        ->whereBetween('created_at', [$date_debut, $date_fin])
                        ->sum('valeurcaf_cfa');

        $amcs_montant = DB::table('amcs')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->sum('totalglobal');

        $amcs_poid = DB::table('amcs')
                        ->whereBetween('created_at', [$date_debut, $date_fin])
                        ->sum('totalpoids');


        $stat_amc = array($amcs, $amcs_depot, $amcs_depot_eff, $amcs_rejet, $amcs_sig, $amcs_montant, $amcs_caf, $amcs_poid);

        $amcs_cont_veh = DB::table('vehicule_amcs')
            ->whereNotNull('numconteneur')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $amcs_cont_mar = DB::table('conteneur_amcs')
            ->whereNotNull('numconteneur')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $amcs_cont_ins = DB::table('ligne_inspection_conteneur_amcs')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $total_cont = $amcs_cont_veh + $amcs_cont_mar;

        $stat_cont = array($total_cont, $amcs_cont_ins);





        $amms = Amms::whereBetween('created_at', [$date_debut, $date_fin])->count();

        $amms_depot = DB::table('prescription_amms')
            ->distinct('idamm')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count('idamm');

        $amms_depot_eff = DB::table('inspection_amms')
            ->distinct('idamm')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count('idamm');

        $amms_rejet = Amms::whereIn('etat', [998, 999])
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $amms_sig = Amms::where('etat','=', 10)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $amms_caf = DB::table('amms')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->sum('valeurcaf_cfa');

        $amms_montant = DB::table('amms')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->sum('totalglobal');

        $amms_poid = DB::table('amms')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->sum('totalpoids');


        $stat_amm = array($amms, $amms_depot, $amms_depot_eff, $amms_rejet, $amms_sig, $amms_montant, $amms_caf, $amms_poid);

        $amms_cont_veh = DB::table('vehicule_amms')
            ->whereNotNull('numconteneur')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $amms_cont_mar = DB::table('conteneur_amms')
            ->whereNotNull('numconteneur')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $amms_cont_ins = DB::table('ligne_inspection_conteneur_amms')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $total_cont_2 = $amms_cont_veh + $amms_cont_mar;

        $stat_cont_2 = array($total_cont_2, $amms_cont_ins);





        $produits_amcs = DB::table('produit_amcs')
            ->distinct('idproduit')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->get();
        $tab_produits_amc = array();
        foreach ($produits_amcs as $produit) {
            if (!in_array($produit->idproduit, $tab_produits_amc)) {
                $tab_produits_amc[] = $produit->idproduit;
            }
        }
        //dd($tab_produits_amc);
        $stat_produit_amc = array();
        foreach ($tab_produits_amc as $idproduit) {

            $produit = Produits::find($idproduit)->libelle;

            $nbre_produits_amc = ProduitAmcs::where('idproduit','=', $idproduit)
                ->whereBetween('created_at', [$date_debut, $date_fin])
                ->count();

            $poids_produit_amc = DB::table('produit_amcs')
                ->where('idproduit','=', $idproduit)
                ->whereBetween('created_at', [$date_debut, $date_fin])
                ->sum('poids');

            $stat_produit_amc[] = array($produit, $nbre_produits_amc, $poids_produit_amc);
        }

        $produits_amms = DB::table('produit_amms')
            ->distinct('idproduit')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->get();
        $tab_produits_amm = array();
        foreach ($produits_amms as $produit) {
            if (!in_array($produit->idproduit, $tab_produits_amm)) {
                $tab_produits_amm[] = $produit->idproduit;
            }
        }

        $stat_produit_amm = array();
        foreach ($tab_produits_amm as $idproduit) {

            $produit = Produits::find($idproduit)->libelle;

            $nbre_produits_amm = ProduitAmms::where('idproduit','=', $idproduit)
                ->whereBetween('created_at', [$date_debut, $date_fin])
                ->count();

            $poids_produit_amm = DB::table('produit_amms')
                ->where('idproduit','=', $idproduit)
                ->whereBetween('created_at', [$date_debut, $date_fin])
                ->sum('poids');

            $stat_produit_amm[] = array($produit, $nbre_produits_amm, $poids_produit_amm);
        }

        return view('pages.dashboard.admin',
            compact('tab_societe', 'withRange', 'stat_amc', 'stat_cont', 'stat_amm',
                'stat_cont_2', 'stat_produit_amc', 'stat_produit_amm'));
    }

    /**
     * Display the specified resource.
     *
     * @param  date  $date_debut,$date_fin
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function userrange($date_debut, $date_fin)
    {
		ini_set('memory_limit', '256M');
        $user = User::find(Auth::id());
        $usager = Contribuables::where('nif', '=', $user->login)->firstOrFail();

        $withRange = true;

        $amcs_lignes = Amcs::select("*")
            ->where('idcontribuable', '=', $usager->id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->get();

        $tab_amc_id = array();
        foreach ($amcs_lignes as $amc) {
            $tab_amc_id[] = $amc->id;
        }
        $amcs = count($tab_amc_id);

        $amcs_depot = DB::table('prescription_amcs')
            ->distinct('idamc')
            ->whereIn('idamc', $tab_amc_id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count('idamc');

        $amcs_depot_eff_lignes = DB::table('inspection_amcs')
            ->distinct('idamc')
            ->whereIn('idamc', $tab_amc_id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            //->count('idamc');
            ->get();
        $tab_depot_id = array();
        foreach ($amcs_depot_eff_lignes as $amcs_depot) {
            $tab_depot_id[] = $amcs_depot->idamc;
        }
        $amcs_depot_eff = count($tab_depot_id);

        $amcs_rejet = Amcs::whereIn('etat', [998, 999])
            ->where('idcontribuable', '=', $usager->id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $amcs_sig = Amcs::where('etat','=', 10)
            ->where('idcontribuable', '=', $usager->id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $amcs_caf = DB::table('amcs')
            ->where('idcontribuable', '=', $usager->id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->sum('valeurcaf_cfa');

        $amcs_montant = DB::table('amcs')
            ->where('idcontribuable', '=', $usager->id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->sum('totalglobal');

        $amcs_poid = DB::table('amcs')
            ->where('idcontribuable', '=', $usager->id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->sum('totalpoids');


        $stat_amc = array($amcs, $amcs_depot, $amcs_depot_eff, $amcs_rejet, $amcs_sig, $amcs_montant, $amcs_caf, $amcs_poid);

        $amcs_cont_veh = DB::table('vehicule_amcs')
            ->whereIn('idamc', $tab_amc_id)
            ->whereNotNull('numconteneur')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $amcs_cont_mar = DB::table('conteneur_amcs')
            ->whereIn('idamc', $tab_amc_id)
            ->whereNotNull('numconteneur')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $amcs_cont_ins = DB::table('ligne_inspection_conteneur_amcs')
            ->whereIn('idinspectionamc', $tab_depot_id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $total_cont = $amcs_cont_veh + $amcs_cont_mar;
        $stat_cont = array($total_cont, $amcs_cont_ins);





        $amms_lignes = Amms::select("*")
            ->where('idcontribuable', '=', $usager->id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->get();

        $tab_amm_id = array();
        foreach ($amms_lignes as $amm) {
            $tab_amm_id[] = $amm->id;
        }
        $amms = count($tab_amc_id);

        $amms_depot = DB::table('prescription_amms')
            ->distinct('idamm')
            ->whereIn('idamm', $tab_amm_id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count('idamm');

        $amms_depot_eff_lignes = DB::table('inspection_amms')
            ->distinct('idamm')
            ->whereIn('idamm', $tab_amc_id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            //->count('idamm');
            ->get();
        $tab_depot_id2 = array();
        foreach ($amms_depot_eff_lignes as $amms_depot) {
            $tab_depot_id2[] = $amms_depot->idamc;
        }
        $amms_depot_eff = count($tab_depot_id2);

        $amms_rejet = Amms::whereIn('etat', [998, 999])
            ->where('idcontribuable', '=', $usager->id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $amms_sig = Amms::where('etat','=', 10)
            ->where('idcontribuable', '=', $usager->id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $amms_caf = DB::table('amms')
            ->where('idcontribuable', '=', $usager->id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->sum('valeurcaf_cfa');

        $amms_montant = DB::table('amms')
            ->where('idcontribuable', '=', $usager->id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->sum('totalglobal');

        $amms_poid = DB::table('amms')
            ->where('idcontribuable', '=', $usager->id)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->sum('totalpoids');


        $stat_amm = array($amms, $amms_depot, $amms_depot_eff, $amms_rejet, $amms_sig, $amms_montant, $amms_caf, $amms_poid);

        $amms_cont_veh = DB::table('vehicule_amms')
            ->whereIn('idamm', $tab_amm_id)
            ->whereNotNull('numconteneur')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $amms_cont_mar = DB::table('conteneur_amms')
            ->whereIn('idamm', $tab_amm_id)
            ->whereNotNull('numconteneur')
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $amms_cont_ins = DB::table('ligne_inspection_conteneur_amms')
            ->whereIn('idinspectionamm', $tab_depot_id2)
            ->whereBetween('created_at', [$date_debut, $date_fin])
            ->count();

        $total_cont_2 = $amms_cont_veh + $amms_cont_mar;

        $stat_cont_2 = array($total_cont_2, $amms_cont_ins);

        return view('pages.dashboard.user',
            compact('withRange', 'stat_amc', 'stat_cont', 'stat_amm', 'stat_cont_2'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('pages.dashboard.index');
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
