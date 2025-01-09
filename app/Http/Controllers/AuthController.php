<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Section_room;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Uspješno ste prijavljeni.');
        }
    
        return back()->withErrors([
            'email' => 'Neispravni podaci za prijavu.',
        ]);
    }
    
    public function dashboard()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('home', compact('user'));
        }
        return redirect("login")->with('error', 'Nemate pristup.');
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
            'first_name' => 'requiredstring|max:255',
            'last_name' => 'requiredstring|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'section_room_id' => 'required|exists:section_room_id',
        ]);
        $data['role_id'] = 2;
        $user = User::create($data);
        Auth::login($user);
        return redirect()->route('home');
    }
}
