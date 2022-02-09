<?php

use App\Http\Controllers\DemandeComptesController;
use Illuminate\Support\Facades\App;
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


Route::group(['middleware' => 'auth'] , function() {

    // $this->middleware
    Route::resource('type-contribuables', 'TypeContribuablesController');
    Route::resource('categorie-produits', 'CategorieProduitsController');
    Route::resource('contribuables', 'ContribuablesController');
    Route::any('contribuables/info', 'ContribuablesController@getcontribuable');


    Route::resource('amm', 'AmmsController');
    Route::resource('amc', 'AmcsController');

    Route::get('demande-comptes/list', 'DemandeComptesController@list');
    Route::resource('demande-comptes', 'DemandeComptesController');

});

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/register', function() {
    return redirect('/login');
});
Route::get('/password/reset', function() {
    return redirect('/login');
});

Route::get('/', function() {
    return redirect('/sales');
});






