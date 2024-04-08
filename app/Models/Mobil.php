<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Mobil extends Model
{
    protected $fillable = [ 
        "id_admin", "brand", "model", "kapasitas", "harga_sewa",
        "deskripsi", "image", "status", "nomor_polisi", "transmisi"
    ];

    protected $table = "Mobil";
    public $timestamps = false;
    use HasFactory;

    static function getCreateRules() {
        return [
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
            "status" => [
                "required",
                Rule::in(["tersedia", "dipinjam", "tidak_tersedia"])
            ],
            "image" => ["nullable", "image"],
            "nomor_polisi" => [
                "required",
                "max:16"
            ],
            "transmisi" => [
                "required",
                Rule::in(["manual", "matic"])
            ],
        ];
    }

    static function getEditRules() {
        return [
            "brand" => ["nullable"],
            "model" => ["nullable"],
            "kapasitas" => [
                "nullable",
                "integer",
                "between:0,999"
            ],
            "harga_sewa" => [
                "nullable", 
                "integer",
                "between:0,9999999999"
            ],
            "deskripsi" => [
                "nullable",
                "max:1024"
            ],
            "status" => [
                "nullable",
                Rule::in(["tersedia", "dipinjam", "tidak_tersedia"])
            ],
            "image" => ["nullable", "image"],
            "nomor_polisi" => [
                "nullable",
                "max:16"
            ],
            "transmisi" => [
                "nullable",
                Rule::in(["manual", "matic"])
            ],
        ];
    }

    public function admin() {
        return $this->belongsTo(Pengguna::class, "id_pengguna");
    }

    public function pesanan() {
        return $this->belongsTo(Pesanan::class, "id");
    }
}
