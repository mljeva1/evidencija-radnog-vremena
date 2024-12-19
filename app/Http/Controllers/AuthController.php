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
    public function showLoginForm()
    {
        $roles = Role::all();
        $sections = Section_room::all();
        return view('auth.login', compact('roles', 'sections'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')->with('success', 'Uspješno ste prijavljeni.');
        }

        return back()->withErrors(['email' => 'Neispravni podaci za prijavu.']);
    }

    public function showRegistrationForm()
    {
        $roles = Role::all(); // Sve role dohvaćene iz baze
        $sections = Section_room::all(); // Sve sekcije dohvaćene iz baze
        return view('auth.register', compact('roles', 'sections')); // Prosljeđivanje u view
    }


    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'section_id' => 'required|exists:section_rooms,id',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'section_id' => $request->section_id,
        ]);

        return redirect()->route('login')->with('success', 'Uspješno ste registrirani. Prijavite se.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Uspješno ste odjavljeni.');
    }
}
