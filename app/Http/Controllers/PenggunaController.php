<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ImageController;
use App\Models\Pengguna;

class PenggunaController extends Controller
{
    public function show() {
        try {
            return Pengguna::all();
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during creating new `Pengguna`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }
    }


    public function showById($id) { 
        try {
            return Pengguna::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            return response()->json([
                "msg" => "No record for `Pengguna` with id:{$id}",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 404);
        }
    }


    public function create(Request $request) { 
        $validator = Validator::make($request->all(), Pengguna::getCreateRules());
        if($validator->fails()) {
            return response()->json([
                "msg" => "Provided data is not valid",
                "reason" => $validator->errors()
            ], 400);
        }

        $userData = $validator->safe()->all();
        $userData["password"] = Hash::make($request["password"]);
        $userData["id_image"] = Image::store()->id;

        try {
            $newPengguna = Pengguna::create($userData);
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during creating new `Pengguna`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }

        return response()->json([
            "msg" => "Created `Pengguna`",
            "insertID" => $newPengguna->id
        ]);
    }


    public function edit($id, Request $request) { 
        $validator = Validator::make($request->all(), Pengguna::getEditRules());
        if($validator->fails()) {
            return response()->json([
                "msg" => "Provided data is not valid",
                "reason" => $validator->errors()
            ], 400);
        }

        $userData = $validator->safe()->all();
        if(isset($userData["password"])) {
            $userData["password"] = Hash::make($request["password"]);
        }

        try {
            $pengguna = Pengguna::findOrFail($id);
            $pengguna->update($userData);

            if($request->hasFile("image")) {
                ImageController::edit($pengguna["id_image"], Pengguna::class, $request->file("image"));
            }
        } catch(ModelNotFoundException $e) {
            return response()->json([ "msg" => "No record for `Pengguna` with id:{$id}", ], 404);
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during creating new `Pengguna`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }

        return response()->json([ "msg" => "Edited `Pengguna` with id:{$id}"]);
    }


    public function destroy($id) { 
        try {
            $pengguna = Pengguna::findOrFail($id);
            $result = $pengguna->delete();
        } catch(ModelNotFoundException $e) {
            return response()->json([ "msg" => "No record for `Pengguna` with id:{$id}", ], 404);
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during deleting this `Pengguna`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }

        return response()->json([ "msg" => "Deleted `Pengguna` with id:{$id}"]);
    }
}