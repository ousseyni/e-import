<?php

namespace App\Http\Controllers;

use App\Amcs;
use App\Amms;
use Illuminate\Http\Request;

class VerifyDemandeController extends Controller
{
    public function VerifyDoc($type, $slug)
    {
        $isExiste = false;
        $dem = ($type == 'AMM' ? Amms::where('slug', '=', $slug) : Amcs::where('slug', '=', $slug)) ;
        if ($dem->exists()) {
            $isExiste = true;
        }
        $demande = $dem->first();
        return view('verify-doc', compact('type', 'demande', 'isExiste'));
    }
}
