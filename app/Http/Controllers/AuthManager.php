<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthManager extends Controller
{
    function login() {
        return view('login');
    }

    function register() {
        return view('register');
    }

    function admin(){
        return view('admin');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'nama' => ["required", "max:255"],
            'email' => ["required", "email:dns", "unique:Pengguna"],
            'password' => ["required", "min:2", "max:255", "confirmed"],
            'password_confirmation' => ['required']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        Pengguna::create($validatedData);

        $request->session()->flash('success', 'Registrasi Berhasil');

        return redirect('/login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'user'){
                return redirect()->intended('/');
            }elseif (Auth::user()->role == 'admin'){
                return redirect()->intended('/admin');
            }
        }
        
        return back()->with('loginError', 'Login Gagal');
    }

    public function logout(Request $request){
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
