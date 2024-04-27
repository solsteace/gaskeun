<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Mobil;
use App\Models\Pengguna;
use App\Models\Pembayaran;

class SiteController extends Controller
{
    //
    public function cars() {
        return view('filterCar', [
            "cars" => Mobil::with("pesanan")->get(),
            "carBrands" => Mobil::select("brand")->distinct()->get()
        ]);
    }

    public function booking() {
        try {
            $car = Mobil::with("pesanan")->findOrFail($_GET["carId"]);
        } catch(ModelNotFoundException $e) {
            return abort(404);
        }

        return view('booking', [ "car" => $car]);
    }

    public function createBooking() {
        try {
            $car = Mobil::with("pesanan")->findOrFail($_GET["carId"]);
        } catch(ModelNotFoundException $e) {
            return abort(404);
        }

        $carIsAvailable  = (
            $car->status == "tersedia" 
            && (
                !($car->pesanan()->exists())
                || !($car->pesanan()
                        ->where('status', 'belum_selesai')
                        ->exists()
                    )
            )
        );

        if(!$carIsAvailable) {
            return redirect("/cars")->with("err", "Mobil ini tidak tersedia! Silakan pilih mobil lainnya");
        }

        return view('inputDetail');
    }

    public function saveBooking(Request $req) {
    }

    public function showMyBookings() {
        $books = DB::table('Pesanan')
                    ->join('Pengguna','Pengguna.id','=','Pesanan.id_pemesan')
                    ->join('Mobil','Mobil.id','=','Pesanan.id_mobil')
                    ->join('Pembayaran','Pembayaran.id','=','Pesanan.id_pembayaran')
                    ->select('Pesanan.*', 'Pengguna.*', 'Mobil.*', 'Pembayaran.*', 'Pesanan.id as id_pesanan')
                    ->where('Pengguna.id', '=', Auth::id())
                    ->get();
        return view("pesananSaya", ["books" => $books]);
    }

}
