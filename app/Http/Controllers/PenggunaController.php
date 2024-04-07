<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Pengguna;

class PenggunaController extends Controller
{
    private $alwaysFillables = ["nama", "email", "password"];

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
        try {
            $newPengguna = Pengguna::create($request->only($alwaysFillables));
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during creating new `Pengguna`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }

        return response().json([
            "msg" => "Created `Pengguna`",
            "insertID" => $newPengguna->id
        ]);
    }


    public function edit($id, Request $request) { 
        try {
            $pengguna = Pengguna::findOrFail($id);
            $pengguna->update($request->only($alwaysFillables + ["image"]));
        } catch(ModelNotFoundException $e) {
            return response()->json([
                "msg" => "No record for `Pengguna` with id:{$id}",
            ], 404);
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
            return response()->json([
                "msg" => "No record for `Pengguna` with id:{$id}",
            ], 404);
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