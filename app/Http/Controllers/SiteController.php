<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Mobil;

class SiteController extends Controller
{
    //
    public function filterCar() {
        return view('filterCar', [
            "cars" => Mobil::with("pesanan")->get(),
            "carBrands" => Mobil::select("brand")->distinct()->get()
        ]);
    }

    public static function booking() {
        try {
            $displayedCar = Mobil::with("pesanan")->findOrFail($_GET["carId"]);
        } catch(ModelNotFoundException $e) {
            return abort(404);
        }

        return view('booking', [
            "car" => $displayedCar, 
        ]);
    }
}
