<?php

namespace App\Http\Controllers;

use App\TypeContribuables;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function VerifyEmail($token = null)
    {
        if ($token == null) {
            session()->flash('message', 'Tentative de connexion invalide');
            return redirect()->route('login');
        }

        $user = User::where('email_verification_token',$token)->first();

        if($user == null ){
            return redirect('/login')->with('error', "Lien d'activation de compte expiré");
        }
        else {

            return view('pages.demande-comptes.create', compact('user'));
        }
    }
}
