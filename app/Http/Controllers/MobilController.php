<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Mobil;

class MobilController extends Controller
{
    public function show() {
        try {
            return Mobil::all();
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during creating new `Mobil`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }
    }


    public function showById($id) { 
        try {
            return Mobil::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            return response()->json([
                "msg" => "No record for `Mobil` with id:{$id}",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 404);
        }
    }


    public function create(Request $request) { 
        $validator = Validator::make($request->all(), Mobil::$createRules);
        if($validator->fails()) {
            return response()->json([
                "msg" => "Provided data is not valid",
                "reason" => $validator->errors()
            ], 400);
        }

        $carData = $validator->safe()->all();
        try {
            $newMobil = Mobil::create($carData);
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during creating new `Mobil`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }

        return response().json([
            "msg" => "Created `Mobil`",
            "insertID" => $newMobil->id
        ]);
    }


    public function edit($id, Request $request) { 
        $validator = Validator::make($request->all(), Mobil::$editRules);
        if($validator->fails()) {
            return response()->json([
                "msg" => "Provided data is not valid",
                "reason" => $validator->errors()
            ], 400);
        }

        $carData = $validator->safe()->all();
        try {
            $mobil = Mobil::findOrFail($id);
            $mobil->update($carData);
        } catch(ModelNotFoundException $e) {
            return response()->json([
                "msg" => "No record for `Mobil` with id:{$id}",
            ], 404);
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during creating new `Mobil`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }

        return response()->json([ "msg" => "Edited `Mobil` with id:{$id}"]);
    }


    public function destroy($id) { 
        try {
            $mobil = Mobil::findOrFail($id);
            $result = $mobil->delete();
        } catch(ModelNotFoundException $e) {
            return response()->json([
                "msg" => "No record for `Mobil` with id:{$id}",
            ], 404);
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during deleting this `Mobil`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }

        return response()->json([ "msg" => "Deleted `Mobil` with id:{$id}"]);
    }
}

