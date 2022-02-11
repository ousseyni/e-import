<?php

namespace App\Http\Controllers;

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
            session()->flash('message', 'Tentative de connexion invalide');
            return redirect()->route('login');
        }

        $user->update([
            'email_verified' => 1,
            'profilid' => 2,
            'email_verified_at' => Carbon::now(),
            'email_verification_token' => ''
        ]);

        session()->flash('message', 'Votre compte est activé, vous pouvez vous connecter maintenant');
        return redirect('/login');
    }
}
