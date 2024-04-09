<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Images;

class ImageController extends Controller
{
    static public function store($id = null, $model = null, $file = null) {
        if(is_null($file)){
            return Images::create([
                "path" => "default.jpg",
                "last_update" => "2069-6-9"
            ]);
        }

        return Images::create([
            "path" => "default.jpg",
            "last_update" => "2069-6-9"
        ]);
    }

    static public function edit($id, $model, $file) {
        $destination = "public/";
        switch($model) {
            case "App\Models\Pengguna":
                $destination .= "avatars/";
                break;
            case "App\Models\Mobil":
                $destination .= "cars/";
                break;
        }

        $filename = Images::find($id);
        Storage::putFileAs($destination, $file, "{$filename["path"]}");
    }
}
