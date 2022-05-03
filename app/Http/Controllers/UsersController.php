<?php

namespace App\Http\Controllers;

use App\Mail\VerificationEmail;
use App\Profils;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $profils = Profils::all();
        return view('pages.users.create', compact('profils'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //Création du user et Email de verification
        $user = User::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'login' => $request->login,
            'profilid' => $request->profilid,
            'password' => bcrypt($request->login),
            'email_verification_token' => Str::slug('vfct-'.Str::random(50), '-')
        ]);

        Mail::to($request->email)->send(new VerificationEmail($user));

        return redirect('/users')->with('success', 'Utilisateur enregistré avec succès');
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
        $profils = Profils::all();
        $user = User::where('slug', '=', $slug)->firstOrFail();

        return view('pages.users.edit', compact('user', 'profils'));
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
            'name' => 'required|max:100',
            'email' => 'required|max:100',
            'login' => 'required|max:100',
            'profilid' => 'required|max:100'
        ]);

        User::where('slug', '=', $slug)->update($validatedData);

        if ($request->password != '') {
            User::where('slug', '=', $slug)->update([
                'password' => bcrypt($request->password),
            ]);
        }
        return redirect('/users')->with('success', 'Utilisateur modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($slug)
    {
        $user = User::where('slug', '=', $slug)->firstOrFail();
        $user->delete();

        return redirect('/users')->with('success', 'Utilisateur supprimé avec succès');
    }
}
