<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Role;
use App\Models\Section_room;

class AuthController extends Controller
{
    //
    public function login()
    {
        $roles = Role::all();
        $sections = Section_room::all();
        return view('auth.login', compact('roles', 'sections'));
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Uspješna prijava, preusmjeravanje na početnu stranicu
            return redirect()->route('home')->with('success', 'Uspješno ste prijavljeni.');
        } else {
            // Neuspješna prijava, vraćanje na login stranicu s porukom o pogrešci
            return back()->withErrors(['email' => 'Neispravni podaci za prijavu.']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }

    public function register()
    {
        $roles = Role::all(); // Sve role dohvaćene iz baze
        $sections = Section_room::all(); // Sve sekcije dohvaćene iz baze
        return view('auth.register', compact('roles', 'sections')); // Prosljeđivanje u view
    }


    public function postRegister(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'section_id' => 'required|exists:section_rooms,id',
        ]);
        $data['role_id'] = 2;
        $user = User::create($data);
        Auth::login($user);
        return redirect('login')->route('login')->with('success', 'Uspješno ste registrirani. Prijavite se.');
    }

    
}
