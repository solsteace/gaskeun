<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class adminController extends Controller
{
    public function showAll() {
        $result = Admin::all();
        $response = [ "msg" => "Item not found" ];

        if(count($result) != 0) {
            $response = ([
                "msg" => "Item found",
                "data" => $result
            ]);
        }

        return $response;
    }

    public function showById($id) {
        $result = Admin::where("id", (int) $id)->first();
        $response = [ "msg" => "Item not found" ];

        if($result != null) {
            $response = ([
                "msg" => "Item found",
                "data" => $result
            ]);
        }

        return $response;
    }

    public function create(Request $request) {
        $admin = new Admin;
        $admin["nama"] = $request["nama"];
        $admin["email"] = $request["email"];
        $admin["password"] = $request["password"]; // Unhashed for now
        $admin["image"] = $request["image"];

        if($admin["image"] == null) {
            $admin["image"] = "";
        }

        $admin->save();

        return json_encode([
            "msg" => "data added successfully",
            "data" => $request->all()
        ]);
    }

    public function edit(Request $request, $id) {
        $result = Admin::where("id", (int) $id)->first();
        $response = [ "msg" => "Item not found" ];
 
        if($result != null) {
            $result["nama"] = $request["nama"];
            $response = [
                "msg" => "Item changed",
                "data" => $result
            ];
        }
    }

    public function destroy($id) {
        $result = Admin::where("id", (int) $id)->first();
        $response = [ "msg" => "Item not found" ];
 
        if($result != null) {
            $response = [
                "msg" => "Item deleted",
                "data" => $result
            ];
            $result->delete();
        }

        return $response;
    }
}
