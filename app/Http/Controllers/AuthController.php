<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Rules\NumeroMatricule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'nom' => 'required',
            'numero' => ['required', new NumeroMatricule],
            'mdp' => 'required|confirmed',

        ])->validate();

        $user = Users::create([
            'nom' => $request->nom,
            'numero' => $request->numero,
            'email' => $request->email,
            'mdp' => Hash::make($request->mdp),
            'role' => 'Consultant',

        ]);

        $user->save();

        return redirect()->route('login')->with('success', 'Compte consultant créé avec succès. Vous pouvez maintenant vous connecter.');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        $request->validate([
            'numero' => 'required',
            'mdp' => 'required',
        ]);

        $utilisateur = Users::where('numero', $request->numero)->first();

        if ($utilisateur && Hash::check($request->mdp, $utilisateur->mdp)) {
            Auth::login($utilisateur);
            // Redirection basée sur le rôle
            if ($utilisateur->role === 'Consultant') {
                return redirect()->intended('/consultant/listeClient'); // Page d'accueil pour consultant
            } elseif ($utilisateur->role === 'Admin') {
                return redirect()->intended('dashboard'); // Page de profil pour admin
            }

            // Redirection par défaut si le rôle ne correspond pas
            return redirect()->intended('login');
        }

        return back()->withErrors([
            'numero' => 'Numéro ou mot de passe invalide.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
}
