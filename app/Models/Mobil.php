<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $fillable = [ 
        "id_admin", "brand", "model", "kapasitas", "harga_sewa",
        "deskripsi", "image", "status", "nomor_polisi", "transmisi"
    ];

    static $createRules = [
        "id_admin" => ["required"],
        "brand" => ["required"],
        "model" => ["required"],
        "kapasitas" => [
            "required",
            "integer",
            "between:0,999"
        ],
        "harga_sewa" => [
            "required", 
            "integer",
            "between:0,9999999999"
        ],
        "deskripsi" => [
            "required",
            "max:1024"
        ],
        "status" => ["required"],
        "image" => ["nullable", "image"],
        "nomor_polisi" => [
            "required",
            "max:16"
        ],
        "transmisi" => ["required"],
    ];

    static $editRules = [
        "brand" => ["required"],
        "model" => ["required"],
        "kapasitas" => [
            "required",
            "integer",
            "between:0,999"
        ],
        "harga_sewa" => [
            "required", 
            "integer",
            "between:0,9999999999"
        ],
        "deskripsi" => [
            "required",
            "max:1024"
        ],
        "status" => ["required"],
        "image" => ["nullable", "image"],
        "nomor_polisi" => [
            "required",
            "max:16"
        ],
        "transmisi" => ["required"],
    ];

    protected $table = "Mobil";
    public $timestamps = false;
    use HasFactory;

    public function admin() {
        return $this->belongsTo(Admin::class, "id_admin");
    }

    public function pesanan() {
        return $this->belongsTo(Pesanan::class, "id");
    }
}
