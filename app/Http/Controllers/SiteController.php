<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Mobil;
use App\Models\Pesanan;

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

        if($car->pesanan != null) {
            return redirect("/cars")->with("err", "Mobil ini tidak tersedia! Silakan pilih mobil lainnya");
        }

        return view('inputDetail');
    }

    public function saveBooking(Request $req) {
    }

    public function myBookings() {

    }

}
