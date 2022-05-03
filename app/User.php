<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'login', 'profilid', 'password', 'email_verification_token',
        'email_verified_at', 'email_verified', 'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($type) {
            $type->slug = Str::slug('usr-'.Str::random(50), '-');
        });
    }

    public function getProfil()
    {
        return $this->belongsTo(Profils::class, 'profilid');
    }
    public function getRoute()
    {
        if ($this->email_verified == 1) {
            if ($this->profilid == 2) {
                return redirect('/accueil')->with('success', 'Bienvenue sur e-Services DGCC');
            }
            else {
                return redirect('/dashboard')->with('success', 'Bienvenue sur e-Services DGCC');
            }
        }
        else {
            if ($this->profilid == 2) {
                return redirect('/verify/'.$this->email_verification_token)->with('success', 'Compte activé avec succès');
            }
            else {
                echo redirect('/verify-compte/'.$this->email_verification_token)->with('success', 'Compte activé avec succès');
            }
        }
    }
}
