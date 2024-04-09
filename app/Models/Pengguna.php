<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pesanan;
use App\Models\Images;

class Pengguna extends Model
{
    protected $fillable = [ "id_image", "nama", "email", "password"];
    protected $table = "Pengguna";
    public $timestamps = false;
    use HasFactory;

    static function getCreateRules() {
        return [
            "nama" => ["required"],
            "email" => [
                "required", 
                "unique:App\Models\Pengguna,email",
                "email:rfc" // Simply checks whether it's a valid email address
            ],
            "password" => ["required"],
        ];
    }

    static function getEditRules() {
        return [
            "nama" => ["nullable"],
            "email" => [
                "nullable", 
                "unique:App\Models\Pengguna,email",
                "email:rfc" // Simply checks whether it's a valid email address
            ],
            "password" => ["nullable"],
            "image" => ["nullable", "image"]
        ];
    }

    public function pesanan() {
        return $this->hasMany(Pesanan::class, "id");
    }

    public function image() {
        return $this->hasOne(Images::class, "id");
    }

}
