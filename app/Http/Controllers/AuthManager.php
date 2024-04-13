<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    function login() {
        return view('login');
    }

    function register() {
        return view('register');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email:dns|unique:pengguna',
            'password' => 'required|min:8|max:255|confirmed',
            'password_confirmation' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        Pengguna::create($validatedData);

        $request->session()->flash('success', 'Registrasi Berhasil');

        return redirect('/login');
    }
}
