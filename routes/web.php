<?php

use App\Http\Controllers\DemandeComptesController;
use App\TypeContribuables;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::group(['middleware' => 'auth'] , function() {

    // $this->middleware
    Route::resource('type-contribuables', 'TypeContribuablesController');
    Route::resource('categorie-produits', 'CategorieProduitsController');
    Route::resource('habilitation', 'HabilitationController');

    Route::any('contribuables/info', 'ContribuablesController@getcontribuable');
    Route::resource('contribuables', 'ContribuablesController');

    Route::any('produits/info', 'ProduitsController@getcategorie');
    Route::any('produits/prix', 'ProduitsController@getprix');
    Route::any('produits/get_prix', 'ProduitsController@get_prix');
    Route::any('produits/get_frais_dossier', 'ProduitsController@get_frais_dossier');
    Route::resource('produits', 'ProduitsController');

    Route::get('amm/paiementodr/{amm}','AmmsController@paiementodr')->name('amm.paiementodr');
    Route::match(['put', 'patch', 'post'],'amm/save_paiement/{amm}', 'AmmsController@save_paiement')->name('amm.save_paiement');

    Route::get('amc/paiementodr/{amc}','AmcsController@paiementodr')->name('amc.paiementodr');
    Route::match(['put', 'patch', 'post'],'amc/save_paiement/{amc}', 'AmcsController@save_paiement')->name('amc.save_paiement');

    Route::resource('amm', 'AmmsController');
    Route::resource('amc', 'AmcsController');

    Route::any('traitement-amm/new', 'TraitementAMMController@new')->name('traitement-amm.new');
    Route::any('traitement-amm/etude', 'TraitementAMMController@etude')->name('traitement-amm.etude');
    Route::any('traitement-amm/valide', 'TraitementAMMController@valide')->name('traitement-amm.valide');
    Route::any('traitement-amm/traite', 'TraitementAMMController@traite')->name('traitement-amm.traite');
    Route::any('traitement-amm/state', 'TraitementAMMController@state')->name('traitement-amm.state');
    Route::any('traitement-amm/etude/{amm}', 'TraitementAMMController@traitement')->name('traitement-amm.traitement');
    Route::get('traitement-amm/dwlord/{amm}','TraitementAMMController@dwlord')->name('traitement-amm.dwlord');
    Route::get('traitement-amm/dwlamm/{amm}','TraitementAMMController@dwlamm')->name('traitement-amm.dwlamm');
    Route::get('traitement-amm/dwlanx/{amm}','TraitementAMMController@dwlanx')->name('traitement-amm.dwlanx');
    Route::get('traitement-amm/dwlrpt/{amm}','TraitementAMMController@dwlrpt')->name('traitement-amm.dwlrpt');
    Route::get('traitement-amm/trace/{amm}','TraitementAMMController@trace')->name('traitement-amm.trace');
    Route::get('traitement-amm/rapport/{amm}','TraitementAMMController@rapport')->name('traitement-amm.rapport');
    Route::match(['put', 'patch', 'post'],'traitement-amm/saverapport/{amm}', 'TraitementAMMController@saverapport')->name('traitement-amm.saverapport');
    Route::match(['put', 'patch', 'post'],'traitement-amm/saveamm', 'TraitementAMMController@saveamm')->name('traitement-amm.saveamm');

    Route::any('traitement-amc/new', 'TraitementAMCController@new')->name('traitement-amc.new');
    Route::any('traitement-amc/etude', 'TraitementAMCController@etude')->name('traitement-amc.etude');
    Route::any('traitement-amc/valide', 'TraitementAMCController@valide')->name('traitement-amc.valide');
    Route::any('traitement-amc/traite', 'TraitementAMCController@traite')->name('traitement-amc.traite');
    Route::any('traitement-amc/state', 'TraitementAMCController@state')->name('traitement-amc.state');
    Route::any('traitement-amc/etude/{amc}', 'TraitementAMCController@traitement')->name('traitement-amc.traitement');
    Route::get('traitement-amc/dwlord/{amc}','TraitementAMCController@dwlord')->name('traitement-amc.dwlord');
    Route::get('traitement-amc/dwlamc/{amc}','TraitementAMCController@dwlamc')->name('traitement-amc.dwlamc');
    Route::get('traitement-amc/dwlanx/{amc}','TraitementAMCController@dwlanx')->name('traitement-amc.dwlanx');
    Route::get('traitement-amc/dwlrpt/{amc}','TraitementAMCController@dwlrpt')->name('traitement-amc.dwlrpt');
    Route::get('traitement-amc/trace/{amc}','TraitementAMCController@trace')->name('traitement-amc.trace');
    Route::get('traitement-amc/rapport/{amc}','TraitementAMCController@rapport')->name('traitement-amc.rapport');
    Route::match(['put', 'patch', 'post'],'traitement-amc/saverapport/{amc}', 'TraitementAMCController@saverapport')->name('traitement-amc.saverapport');
    Route::match(['put', 'patch', 'post'],'traitement-amc/saveamc', 'TraitementAMCController@saveamc')->name('traitement-amc.saveamc');

    Route::resource('traitement-amc', 'TraitementAMCController');
    Route::resource('traitement-amm', 'TraitementAMMController');

    Route::resource('devises', 'DeviseController');
    Route::resource('frais-dossiers', 'FraisDossierController');
    Route::resource('prescriptions', 'PrescriptionController');


    Route::any('profil/details/{prf}', 'ProfilsController@details')->name('profils.details');
    Route::resource('profils', 'ProfilsController');

    Route::any('dashboard/admin', 'DashboardController@admin')->name('dashboard.admin');
    Route::any('dashboard/admin/{debut}/{fin}', 'DashboardController@adminrange')->name('dashboard.adminrange');
    Route::any('dashboard/user', 'DashboardController@user')->name('dashboard.user');
    Route::resource('dashboard', 'DashboardController');

    Route::resource('users', 'UsersController');

    Route::get('logout', 'Auth\LoginController@logout');

    Route::get('demande-comptes/list', 'DemandeComptesController@list');


    Route::get('/accueil', function() {
        $data = [
            'category_name' => 'Accueil',
            'page_name' => 'Bienvenue sur e-Services DGCC',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return view('accueil')->with($data);
    });

});

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/password/reset', function() {
    return redirect('/login');
});

Route::get('/register', function() {
    return redirect('/demande-comptes');
});

Route::get('/demande-comptes/index', function() {
    return redirect('/demande-comptes');
});

Route::get('/', function() {
    if (Auth::user()) {
        $user = Auth::user();
        return $user->getRoute();
    }
    else {
        return redirect('/login');
    }
});

Route::get('/demande-comptes/connexion', function() {
    return redirect('/connexion');
});
Route::view('/connexion', 'pages.demande-comptes.connexion');


Route::get('demande-comptes/compte', 'DemandeComptesController@compte')->name('demande-comptes.compte');
Route::get('/demande-comptes', function() {
    $typeContribuables = TypeContribuables::all(['id', 'libelle']);
    return view('pages.demande-comptes.index', compact('typeContribuables'));
});
Route::match(['put', 'patch'],'demande-comptes/activate/{token}', 'DemandeComptesController@activate');
Route::match(['put', 'patch'],'demande-comptes/activate-compte/{token}', 'DemandeComptesController@ActivateCompte');

Route::resource('demande-comptes', 'DemandeComptesController');


Route::get('/verify/{token}', 'VerifyController@VerifyEmail');
Route::get('/verify-compte/{token}', 'VerifyController@VerifyCompte');
Route::get('/verify-doc/{type}/{slug}', 'VerifyDemandeController@VerifyDoc');

Route::get('/pass_recovery', function() {
    // $category_name = 'auth';
    $data = [
        'category_name' => 'auth',
        'page_name' => 'auth_default',
        'has_scrollspy' => 0,
        'scrollspy_offset' => '',
    ];
    // $pageName = 'auth_default';
    return view('pages.authentication.auth_pass_recovery')->with($data);
});

Route::get('routes', function () {
    $routeCollection = Route::getRoutes();

    echo "<table style='width:100%'>";
    echo "<tr>";
    echo "<td width='10%'><h4>HTTP Method</h4></td>";
    echo "<td width='10%'><h4>Route</h4></td>";
    echo "<td width='10%'><h4>Name</h4></td>";
    echo "<td width='70%'><h4>Corresponding Action</h4></td>";
    echo "</tr>";
    foreach ($routeCollection as $value) {
        echo "<tr>";
        echo "<td>" . $value->methods()[0] . "</td>";
        echo "<td>" . $value->uri() . "</td>";
        echo "<td>" . $value->getName() . "</td>";
        echo "<td>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
    echo "</table>";
});

