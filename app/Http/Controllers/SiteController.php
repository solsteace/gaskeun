<?php

namespace App\Http\Controllers;

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
}
