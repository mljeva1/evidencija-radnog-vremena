<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
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
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')->with('success', 'Uspješno ste prijavljeni.');
        } else {
            // Neuspješna prijava, vraćanje na login stranicu s porukom o pogrešci
            return back()->withErrors(['email' => 'Neispravni podaci za prijavu.']);
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect('login');
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'section_id' => 'required|exists:section_room_id',
        ]);
        $data['role_id'] = 2;
        $data = $request->all();
        $check = $this->create($data);
        /* $user = User::create($data);
        Auth::login($user); */
        return redirect('login')->route('login')->with('success', 'Uspješno ste registrirani. Prijavite se.');
    }
    public function dashboard()
    {
        if (Auth::check()) {
            return view('home');
        }
        return redirect("login")->withSuccess('You do not have access');
    }
    public function  create(array $data) {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'section_rooms_id' => $data['section_room_id']
        ]);
    }
    
}
