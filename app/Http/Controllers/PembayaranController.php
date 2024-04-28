<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function show() {
        try {
            return Pembayaran::all();
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during creating new `Pembayaran`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }
    }


    public function showById($id) { 
        try {
            return Pembayaran::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            return response()->json([
                "msg" => "No record for `Pembayaran` with id:{$id}",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 404);
        }
    }


    public function create(Request $request) { 
        $validator = Validator::make($request->all(), Pembayaran::getCreateRules());
        if($validator->fails()) {
            return response()->json([
                "msg" => "Provided data is not valid",
                "reason" => $validator->errors()
            ], 400);
        }

        $paymentData = $validator->safe()->all();
        try {
            $newPembayaran = Pembayaran::create($paymentData);
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during creating new `Pembayaran`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }

        return response()->json([
            "msg" => "Created `Pembayaran`",
            "insertID" => $newPembayaran->id
        ]);
    }


    public function edit($id, Request $request) { 
        $validator = Validator::make($request->all(), Pembayaran::getEditRules());
        if($validator->fails()) {
            return response()->json([
                "msg" => "Provided data is not valid",
                "reason" => $validator->errors()
            ], 400);
        }

        $paymentData = $validator->safe()->all();
        try {
            $pembayaran = Pembayaran::findOrFail($id);
            $pembayaran->update($paymentData);
        } catch(ModelNotFoundException $e) {
            return response()->json([ "msg" => "No record for `Pembayaran` with id:{$id}", ], 404);
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during creating new `Pembayaran`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }

        return response()->json([ "msg" => "Edited `Pembayaran` with id:{$id}"]);
    }


    public function destroy($id) { 
        try {
            $pembayaran = Pembayaran::findOrFail($id);
            $result = $pembayaran->delete();
        } catch(ModelNotFoundException $e) {
            return response()->json([ "msg" => "No record for `Pembayaran` with id:{$id}", ], 404);
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during deleting this `Pembayaran`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }

        return response()->json([ "msg" => "Deleted `Pembayaran` with id:{$id}"]);
    }
}
