<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use App\Models\Mobil;
use App\Models\Images;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

    public function pesanan(Request $request) {
        // Menyimpan data Pesanan, Pengguna, Mobil, Pembayaran, Pesanan dari database dan menambahkan searching dengan where
        $data = DB::table('Pesanan')
                    ->join('Pengguna','Pengguna.id','=','Pesanan.id_pemesan')
                    ->join('Mobil','Mobil.id','=','Pesanan.id_mobil')
                    ->join('Pembayaran','Pembayaran.id','=','Pesanan.id_pembayaran')
                    ->where('Pesanan.nama_peminjam', 'like', '%'.$request->search.'%')
                    ->orWhere('Pesanan.tanggal_peminjaman', 'like', '%'.$request->search.'%')
                    ->orWhere('Pesanan.tanggal_pengembalian', 'like', '%'.$request->search.'%')
                    ->orWhere('Mobil.nomor_polisi', 'like', '%'.$request->search.'%')
                    ->select('Pesanan.*', 'Pengguna.*', 'Mobil.*', 'Pembayaran.*', 'Pesanan.id as id_pesanan', 'Pesanan.status as status_pesanan')
                    ->orderBy('Pesanan.id', 'desc')
                    ->get();

        // return view pesanan dan data 
        return view('pesanan')->with('data',$data);
    }

    public function konfirmasiPesanan($id){
        $pesanan = Pesanan::findOrFail( $id );
        $pembayaran = Pembayaran::findOrFail($pesanan->id_pembayaran);
        $pembayaran->status = 'lunas';
        $pembayaran->save();
        return redirect('/admin/pesanan')->with('success', 'Pesanan Berhasil Dikonfirmasi');
    }

    public function selesaikanPesanan($id){
        $pesanan = Pesanan::findOrFail( $id );
        $mobil = Mobil::findOrFail($pesanan->id_mobil);
        $mobil->status = 'tersedia';
        $pesanan->status = 'selesai';
        $mobil->save();
        $pesanan->save();

        return redirect('/admin/pesanan')->with('success', 'Pesanan Selesai');
    }

    public function deletePesanan($id){
        $pesanan = Pesanan::find($id);
        $pesanan->delete();
        
        return redirect('/admin/pesanan')->with('success', 'Pesanan Berhasil Dihapus');
    }
    public function mobil(Request $request){
        $data = DB::table('Mobil')
                    ->join('Images','Images.id','=','Mobil.id_image')
                    ->leftJoin('Pesanan','Pesanan.id_mobil','=','Mobil.id')
                    ->select('Mobil.*', 'Images.*', 'Pesanan.tanggal_pengembalian', 'Images.id as id_image', 'Mobil.id as id_mobil')
                    ->where('Mobil.brand', 'like', '%'.$request->search.'%')
                    ->orWhere('Mobil.model', 'like', '%'.$request->search.'%')
                    ->orWhere('Mobil.nomor_polisi', 'like', '%'.$request->search.'%')
                    ->orWhere('Mobil.transmisi', 'like', '%'.$request->search.'%')
                    ->orWhere('Mobil.bahan_bakar', 'like', '%'.$request->search.'%')
                    ->orderByRaw('CASE 
                                    WHEN Mobil.status = "tersedia" THEN 0 
                                    WHEN Mobil.status = "tidak_tersedia" AND Pesanan.id IS NOT NULL THEN 1 
                                    ELSE 2 
                                END')
                    ->orderBy('Mobil.status', 'asc')
                    ->orderBy('Mobil.brand', 'asc')
                    ->get();

        return view('mobil')->with('data',$data);
    }

    public function addMobil(){
        return view('addMobil');
    }

    public function admin(){
        $allCar = Mobil::count();
        $mobilTersedia = Mobil::where('status', 'tersedia')->count();
        $mobilTidakTersedia = Mobil::where('status', 'tidak_tersedia')->count();
        $allBooked = Pesanan::count();

        return view('admin', compact('allCar', 'mobilTersedia', 'mobilTidakTersedia', 'allBooked'));
    }

    public function editMobil($id){
        $mobil = Mobil::find($id);
        return view('editMobil')->with('mobil',$mobil);
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
            'status' => ['required'],
            'nomor_polisi' => ['required', 'string'],
            'transmisi' => ['required'],
            'bahan_bakar' => ['required'],
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
        $mobil->status = $validatedData['status'];
        $mobil->nomor_polisi = $validatedData['nomor_polisi'];
        $mobil->transmisi = $validatedData['transmisi'];
        $mobil->bahan_bakar = $validatedData['bahan_bakar'];
        $mobil->save();

        return redirect('/admin/mobil/add-mobil')->with('success', 'Mobil Berhasil Ditambahkan');
    }

    public function deleteMobil($id){
        $mobil = Mobil::find($id);
        $mobil->delete();
        Images::where('id', $mobil->id_image)->delete();


        return redirect('/admin/mobil')->with('success', 'Mobil Berhasil Dihapus');
    }

    public function edit($id, Request $request) { 
        $validatedData = $request->validate([
            'brand' => ['required', 'string'],
            'model' => ['required', 'string'],
            'kapasitas' => ['required', 'numeric'],
            'harga_sewa' => ['required', 'numeric'],
            'deskripsi' => ['required', 'string'],
            'status' => ['required'],
            'nomor_polisi' => ['required', 'string'],
            'transmisi' => ['required'],
            'bahan_bakar' => ['required'],
            'image' => ['image', 'mimes:jpeg,png,jpg'],
        ]);

        $mobil = Mobil::findOrFail($id);
        $mobil->update($validatedData);
        
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-mobil');
            $image = Images::findOrFail($mobil->id_image);
            $image->path =$validatedData['image'];
            $image->save();
        }

        return redirect('/admin/mobil')->with('success', 'Mobil Berhasil Diedit');
    }
}
