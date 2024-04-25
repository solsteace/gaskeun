<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Mobil;
use App\Models\Images;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthManager extends Controller
{
    public function login() {
        return view('login');
    }

    public function register() {
        return view('register');
    }

    public function booking(){
        return view('booking');
    }

    public function pesanan(){
        return view('pesanan');
    }

    public function mobil(){
        $mobil = Mobil::join('Images', 'Images.id', '=', 'Mobil.id_image')->get();
        return view('mobil')->with('mobil',$mobil);
    }

    public function addMobil(){
        return view('addMobil');
    }

    public function admin(){
        return view('admin');
    }

    public function editMobil(){
        return view('editMobil');
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

    public function createMobil(Request $request){
        $validatedData = $request->validate([
            'brand' => ['required', 'string'],
            'model' => ['required', 'string'],
            'kapasitas' => ['required', 'numeric'],
            'harga_sewa' => ['required', 'numeric'],
            'deskripsi' => ['required', 'string'],
            'nomor_polisi' => ['required', 'string'],
            'transmisi' => ['required'],
            'image' => ['required','image', 'mimes:jpeg,png,jpg'],
        ]);
        
        $validatedData['image'] = $request->file('image')->store('post-mobil');

        $image = new Images();
        $image->path = $validatedData['image'];
        $image->last_update = now();
        $image->save();

        $mobil = new Mobil();
        $mobil->id_pengguna = auth()->user()->id;
        $mobil->id_image = $image->id;
        $mobil->brand = $validatedData['brand'];
        $mobil->model = $validatedData['model'];
        $mobil->kapasitas = $validatedData['kapasitas'];
        $mobil->harga_sewa = $validatedData['harga_sewa'];
        $mobil->deskripsi = $validatedData['deskripsi'];
        $mobil->nomor_polisi = $validatedData['nomor_polisi'];
        $mobil->transmisi = $validatedData['transmisi'];
        $mobil->save();

        return redirect('/admin/mobil/add-mobil')->with('success', 'Mobil Berhasil Ditambahkan');
    }

}
