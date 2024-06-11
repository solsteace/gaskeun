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
use Storage;

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
                    ->orWhere('Pembayaran.status', '=', $request->search)
                    ->select('Pesanan.*', 'Pengguna.*', 'Mobil.*', 'Pembayaran.*', 'Pesanan.id as id_pesanan', 'Pesanan.status as status_pesanan')
                    ->orderBy('Pesanan.tanggal_peminjaman', 'asc')
                    ->get();

        // return view pesanan dan data 
        return view('pesanan')->with('data',$data);
    }

    public function konfirmasiPesanan($id){
        // Mencari Pesanan dan Pembayaran berdasarkan ID 
        $pesanan = Pesanan::findOrFail( $id );
        $pembayaran = Pembayaran::findOrFail($pesanan->id_pembayaran);
        // Mengubah status pembayaran menjadi lunas
        $pembayaran->status = 'lunas';
        // Simpan data pembayaran ke table pembayaran
        $pembayaran->save();
        // Mengarahkan ke halaman /admin/pesanan dan pesan sukses
        return redirect('/admin/pesanan')->with('success', 'Pesanan Berhasil Dikonfirmasi');
    }

    public function selesaikanPesanan($id){
        // Mencari Pesanan dan Mobil berdasarkan ID 
        $pesanan = Pesanan::findOrFail( $id );
        $mobil = Mobil::findOrFail($pesanan->id_mobil);
        // Ubah status mobil menjadi tersedia dan status pesanan menjadi selesai
        $mobil->status = 'tersedia';
        $pesanan->status = 'selesai';
        // Simpan data ke dalam database
        $mobil->save();
        $pesanan->save();
        // Mengarahkan ke halaman /admin/pesanan dan pesan sukses
        return redirect('/admin/pesanan')->with('success', 'Pesanan Selesai');
    }

    public function deletePesanan($id){
        // Mencari Pesanan berdasarkan ID
        $pesanan = Pesanan::find($id);
        // Delete pesanan di database
        $pesanan->delete();
        // Mengarahkan ke halaman /admin/pesanan dan pesan sukses
        return redirect('/admin/pesanan')->with('success', 'Pesanan Berhasil Dihapus');
    }
    public function mobil(Request $request){
        // Menyimpan data Mobil, Images, Pesanan dari database dan menambahkan searching dengan where
        $data = DB::table('Mobil')
                    ->join('Images','Images.id','=','Mobil.id_image')
                    ->leftJoin('Pesanan','Pesanan.id_mobil','=','Mobil.id')
                    ->select('Mobil.*', 'Images.*', 'Pesanan.tanggal_pengembalian', 'Images.id as id_image', 'Mobil.id as id_mobil')
                    ->where('Mobil.brand', 'like', '%'.$request->search.'%')
                    ->orWhere('Mobil.model', 'like', '%'.$request->search.'%')
                    ->orWhere('Mobil.nomor_polisi', 'like', '%'.$request->search.'%')
                    ->orWhere('Mobil.transmisi', 'like', '%'.$request->search.'%')
                    ->orWhere('Mobil.bahan_bakar', 'like', '%'.$request->search.'%')
                    ->orWhere('Mobil.status', '=', $request->search)
                    ->orderByRaw('CASE 
                                    WHEN Mobil.status = "tersedia" THEN 0 
                                    WHEN Mobil.status = "tidak_tersedia" AND Pesanan.id IS NOT NULL THEN 1 
                                    ELSE 2 
                                END')
                    ->orderBy('Mobil.status', 'asc')
                    ->orderBy('Mobil.brand', 'asc')
                    ->get();
        // return view mobil dan data 
        return view('mobil')->with('data',$data);
    }

    public function addMobil(){
        // return view add-mobil dan data 
        return view('addMobil');
    }

    public function admin(){
        // Mendapatkan jumlah data dalam database untuk statistik
        $allCar = Mobil::count();
        $mobilTersedia = Mobil::where('status', 'tersedia')->count();
        $mobilTidakTersedia = Mobil::where('status', 'tidak_tersedia')->count();
        $allBooked = Pesanan::count();
        $data = DB::table('Pesanan')
                    ->join('Mobil','Mobil.id','=','Pesanan.id_mobil')
                    ->join('Pembayaran','Pembayaran.id','=','Pesanan.id_pembayaran')
                    ->where('Pembayaran.status', 'belum_lunas')
                    ->select('Pesanan.*', 'Mobil.*', 'Pembayaran.*')
                    ->get();

        // return view admin dan 'allCar', 'mobilTersedia', 'mobilTidakTersedia', 'allBooked'
        return view('admin', compact('allCar', 'mobilTersedia', 'mobilTidakTersedia', 'allBooked', 'data'));
    }

    public function editMobil($id){
        // Mencari data Mobil berdasarkan ID
        $mobil = Mobil::find($id);
        // return view editMobil dan mobil 
        return view('editMobil')->with('mobil',$mobil);
    }

    public function store(Request $request) {
        // Validasi data dari request
        $validatedData = $request->validate([
            'nama' => ["required", "max:255"],
            'email' => ["required", "email:dns", "unique:Pengguna"],
            'password' => ["required", "min:8", "max:255", "confirmed"],
            'password_confirmation' => ['required']
        ]);

        // Hash password yang di validasi
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Membuat pengguna di database
        Pengguna::create($validatedData);

        // Membuat session dan mengembalikan pesan sukses
        $request->session()->flash('success', 'Registrasi Berhasil');

        // return ke halaman /login
        return redirect('/login');
    }

    public function registerApi(Request $request){
        $validator = Validator::make($request->all(),[
            'nama' => ["required", "max:255"],
            'email' => ["required", "email:dns", "unique:Pengguna"],
            'password' => ["required", "min:8", "max:255", "confirmed"],
            'password_confirmation' => ['required']
        ]);

        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => null
            ]);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = Pengguna::create($input);

        // $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->nama;
        $success['email'] = $user->email;
        $success['id'] = $user->id;

        return response()->json([
            'success' => true,
            'message' => 'Register Success',
            'data' => $success 
        ]);
    }

    public function loginApi(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;
            $success['name'] = $auth->nama;
            $success['email'] = $auth->email;
            $success['id'] = $auth->id;

            return response()->json([
                'success' => true,
                'message' => 'Login Success',
                'data' => $success 
            ]);
        }else{
            return response()->json([
            'success' => false,
            'message' => 'Cek Email dan Password',
            'data' => null
        ]);
        }
    }

    public function logoutApi(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Logout Success',
            'data' => null
        ]);
    }

    public function authenticate(Request $request){
        // Validasi data dari request
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);
 
        // mengarahkan user ke halaman landing page dan admin ke /admin
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'user'){
                return redirect()->intended('/');
            }elseif (Auth::user()->role == 'admin'){
                return redirect()->intended('/admin');
            }
        }
        
        //return ke halaman login dan menampilkan pesan login gagal
        return back()->with('loginError', 'Login Gagal');
    }

    public function logout(Request $request){
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    public function createMobil(Request $request){
        // Validasi data request
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
        
        // store image ke folder storage/post-mobil
        $validatedData['image'] = $request->file('image')->store('post-mobil');

        // membuat image baru di database
        $image = new Images();
        $image->path = $validatedData['image'];
        $image->last_update = now();
        $image->save();

        // membuat mobil baru di database
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

        // return ke halaman /admin/mobil/add-mobil dan pesan sukses
        return redirect('/admin/mobil/add-mobil')->with('success', 'Mobil Berhasil Ditambahkan');
    }

    public function deleteMobil($id){
        // Mencari mobil berdasarkan ID
        $mobil = Mobil::find($id);
        // Hapus mobil
        $mobil->delete();

        // delete image from storage
        $image = Images::find($mobil->id_image);
        Storage::delete($image->path);

        // menghapus gambar dari mobil
        Images::where('id', $mobil->id_image)->delete();

        // Mengarahkan /admin/mobil dan pesan sukses
        return redirect('/admin/mobil')->with('success', 'Mobil Berhasil Dihapus');
    }

    public function edit($id, Request $request) { 
        // Validasi data request
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

        // Mencari data mobil berdasarkan ID
        $mobil = Mobil::findOrFail($id);
        // Update data mobil di table Mobil
        $mobil->update($validatedData);
        
        // Updata image jika image ada atau not null
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-mobil');
            $image = Images::findOrFail($mobil->id_image);
            // delete image from storage
            Storage::delete($image->path);
            $image->path =$validatedData['image'];
            $image->save();
        }

        // Mengarahkan halaman /admin/mobil dan pesan sukses
        return redirect('/admin/mobil')->with('success', 'Mobil Berhasil Diedit');
    }
}
