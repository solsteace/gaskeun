<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Pengguna;
use App\Models\Pesanan;
use App\Models\Mobil;
use App\Models\Pembayaran;

class MobilFilterController extends Controller
{
    public function show(Request $request) {
        $validator = Validator::make($request->all(),
            [   
                "brand" => [ "nullable", "string" ],
                "transmission" => [ "nullable", "string"],
                "numPassengers" => [ "nullable", "integer" ],
                "minPrice" => [ "nullable", "integer" ],
                "maxPrice" => [ "nullable", "integer" ],
                "startDate" => [ "nullable",  "date" ],
                "endDate" => [ "nullable", "date" ]
            ]
        );

        if($validator->fails()) {
            return response()->json([
                "msg" => "Filtering not performed",
                "reason" => $validator->errors()
            ], 405);
        }

        $data = Mobil::with("pesanan")->get();
        $filters = $validator->safe()->all();
        foreach($filters as $filter => $value) {
            if($value != null) {
                switch($filter) {
                    case "brand":
                        $data = $data->where("brand", "=", $value);
                        break;
                    case "transmission":
                        $data = $data->where("transmisi", "=", $value);
                        break;
                    case "numPassengers":
                        $data = $data->where("kapasitas", ">=", $value);
                        break;
                    case "minPrice":
                        $data = $data->where("harga_sewa", ">=", $value);
                        break;
                    case "maxPrice":
                        $data = $data->where("harga_sewa", "<=", $value);
                        break;
                    case "startDate":
                        $data = $data->where("pesanan.tanggal_peminjaman", ">=", $value);
                        break;
                    case "endDate":
                        $data = $data->where("pesanan.tanggal_pengembalian", "<=", $value);
                        break;
                }
            }
        }

        return response()->json($data);
    }
}
