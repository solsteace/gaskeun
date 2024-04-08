<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pesanan;

class PesananController extends Controller
{
    public function show() {
        try {
            return Pesanan::all();
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during creating new `Pesanan`",
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
        $validator = Validator::make($request->all(), Pesanan::$createRules);
        if($validator->fails()) {
            return response()->json([
                "msg" => "Provided data is not valid",
                "reason" => $validator->errors()
            ], 400);
        }


        $orderData = $validator->safe()->all();
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

        return response()->json([
            "msg" => "Created `Pesanan`",
            "insertID" => $newPesanan->id
        ]);
    }


    public function edit($id, Request $request) { 
        $validator = Validator::make($request->all(), Pesanan::$editRules);
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
