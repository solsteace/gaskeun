<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\Models\Pesanan;
use App\Models\Pengguna;
use App\Models\Images;

class Mobil extends Model
{
    protected $fillable = [ 
        "id_pengguna", "id_image", "brand", "model", "kapasitas", "harga_sewa",
        "deskripsi", "status", "nomor_polisi", "transmisi"
    ];

    protected $table = "Mobil";
    public $timestamps = false;
    use HasFactory;

    static function getCreateRules() {
        return [
            "id_pengguna" => ["required"],
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
            "nomor_polisi" => [
                "required",
                "max:16"
            ],
            "transmisi" => [
                "required",
                Rule::in(["manual", "matic"])
            ],
            "image" => ["nullable", "image"]
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
            "nomor_polisi" => [
                "nullable",
                "max:16"
            ],
            "transmisi" => [
                "nullable",
                Rule::in(["manual", "matic"])
            ],
            "image" => ["nullable", "image"]
        ];
    }

    public function pengguna() {
        return $this->belongsTo(Pengguna::class, "id_pengguna");
    }

    public function pesanan() {
        return $this->belongsTo(Pesanan::class, "id");
    }

    public function image() {
        return $this->hasOne(Image::class, "id");
    }
}
