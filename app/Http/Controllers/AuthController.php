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
         $credentials = $request->only('email','password');

         if(Auth::attempt($credentials)) {
            return redirect()->route('home');
         }

         return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
         ]);
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
