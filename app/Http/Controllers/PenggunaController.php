<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
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
        $req = [
            "nama" => "",
            "email" => "",
            "password" => "",
            "image" => "default.png",
            "role" => "user"
        ];

        foreach (explode("&", $request->getContent()) as $formEntry) {
            $keyValue = explode("=", $formEntry);
            $req[$keyValue[0]] = $keyValue[1];
        }

        $newPengguna = new Pengguna;
        $newPengguna["nama"] = $req["nama"];
        $newPengguna["email"] = $req["email"];
        $newPengguna["password"] = $req["password"];
        $newPengguna["image"] = $req["image"];
        $newPengguna["role"] = "user";
        try {
            $newPengguna->save();
        } catch(QueryException $e) {
            return response()->json([
                "msg" => "Exception raised during creating new `Pengguna`",
                "reason" => (env("APP_ENV", "local") == "local"? 
                        $e->getMessage(): "[DISCLOSED]"
                )
            ], 500);
        }

        return json_encode([
            "msg" => "Created `Pengguna`",
            "insertID" => $newPengguna->id
        ]);
    }


    public function edit($id, Request $request) { 
        try {
            $pengguna = Pengguna::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            return response()->json([
                "msg" => "No record for `Pengguna` with id:{$id}",
            ], 404);
        }

        $req = [ // old values stored here
            "nama" => $pengguna["nama"],
            "email" => $pengguna["email"],
            "password" => $pengguna["password"],
            "image" => $pengguna["image"],
        ];

        foreach (explode("&", $request->getContent()) as $formEntry) {
            $keyValue = explode("=", $formEntry);
            $req[$keyValue[0]] = $keyValue[1];
        }

        $pengguna["nama"] = $req["nama"];
        $pengguna["email"] = $req["email"];
        $pengguna["password"] = $req["password"];
        $pengguna["image"] = $req["image"];
        try {
            $pengguna->save();
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