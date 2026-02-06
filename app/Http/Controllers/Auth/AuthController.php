<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Affiche le formulaire de connexion
    public function showLogin()
    {
        return view('auth.login');
    }

    // Traite la connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cherche l'utilisateur
        $user = User::where('email', $credentials['email'])->first();
        
        if (!$user) {
            return back()->with('error', '❌ Cet email n\'existe pas. Vérifiez que vous avez exécuté php artisan db:seed')->withInput($request->only('email'));
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', '✅ Connecté avec succès')->with('alert_type', 'success');
        }

        return back()->with('error', '❌ Email ou mot de passe incorrect')->withInput($request->only('email'));
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', '👋 Déconnecté avec succès');
    }
}
