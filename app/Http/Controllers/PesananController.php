<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Pesanan;
use App\Models\Mobil;

class PesananController extends Controller
{
    public function show() {
        try {
            return Pesanan::all();
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during showing `Pesanan`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }
    }

    public function showByUser($id) {
        try {
            return DB::table('Pesanan')
                    ->join('Pengguna','Pengguna.id','=','Pesanan.id_pemesan')
                    ->join('Mobil','Mobil.id','=','Pesanan.id_mobil')
                    ->join('Pembayaran','Pembayaran.id','=','Pesanan.id_pembayaran')
                    ->join('Images','Images.id','=','Mobil.id_image')
                    ->select(
                        'Pesanan.*', 'Pengguna.*', 
                        'Mobil.*', 'Pembayaran.*', 
                        'Pesanan.id as id_pesanan', 
                        "Pesanan.status as pesanan_status",
                        "Mobil.status as mobil_status",
                        "Images.path as path"
                    )
                    ->where('Pengguna.id', '=', $id)
                    ->orderBy("Pesanan.id", "desc")
                    ->get();
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during showing `Pesanan`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }
    }

    public function showById($id) { 
        try {
            return Pesanan::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            return response()->json([
                "msg" => "No record for `Pesanan` with id:{$id}",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 404);
        }
    }


    public function create(Request $request) { 
        $validator = Validator::make($request->all(), Pesanan::getCreateRules());
        if($validator->fails()) {
            return response()->json([
                "msg" => "Provided data is not valid",
                "reason" => $validator->errors()
            ], 400);
        }
        
        // Restrict car listed on many `Pesanan` records
        $orderData = $validator->safe()->all();
        $isBookedCar = (count(Pesanan::where("id_mobil", "=", $orderData["id_mobil"])
                            ->where("status", "=", "belum_selesai")->get()) > 0);
        if($isBookedCar) {
            return response()->json([
                "msg" => "Provided data is not valid",
                "reason" => "This car has already been booked",
            ], 400);
        }

        $orderData["SIM_peminjam"] = $request->file('SIM_peminjam')->store('sim-peminjam');
        try {
            $newPesanan = Pesanan::create($orderData);
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during creating new `Pesanan`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }

        $mobil = Mobil::find($orderData["id_mobil"]);
        $mobil->status = "tidak_tersedia";
        $mobil->save();

        return response()->json([
            "msg" => "Created `Pesanan`",
            "insertID" => $newPesanan->id
        ]);
    }


    public function edit($id, Request $request) { 
        $validator = Validator::make($request->all(), Pesanan::getEditRules());
        if($validator->fails()) {
            return response()->json([
                "msg" => "Provided data is not valid",
                "reason" => $validator->errors()
            ], 400);
        }

        $orderData = $validator->safe()->all();
        try {
            $pesanan = Pesanan::findOrFail($id);
            $pesanan->update($orderData);
        } catch(ModelNotFoundException $e) {
            return response()->json([ "msg" => "No record for `Pesanan` with id:{$id}", ], 404);
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during creating new `Pesanan`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }

        return response()->json([ "msg" => "Edited `Pesanan` with id:{$id}"]);
    }


    public function destroy($id) { 
        try {
            $pesanan = Pesanan::findOrFail($id);
            $result = $pesanan->delete();
        } catch(ModelNotFoundException $e) {
            return response()->json([ "msg" => "No record for `Pesanan` with id:{$id}", ], 404);
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during deleting this `Pesanan`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }

        return response()->json([ "msg" => "Deleted `Pesanan` with id:{$id}"]);
    }

}
