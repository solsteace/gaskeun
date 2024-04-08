<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pesanan;

class Pengguna extends Model
{
    protected $fillable = [ "nama", "email", "password", "image" ];
    protected $table = "Pengguna";
    public $timestamps = false;
    use HasFactory;

    static $createRules = [
        "nama" => ["required"],
        "email" => [
            "required", 
            "unique:App\Models\Pengguna,email",
            "email:rfc" // Simply checks whether it's a valid email address
        ],
        "password" => ["required"],
    ];

    static $editRules = [
        "nama" => ["nullable"],
        "email" => [
            "nullable", 
            "unique:App\Models\Pengguna,email",
            "email:rfc" // Simply checks whether it's a valid email address
        ],
        "password" => ["nullable"],
        "image" => ["nullable", "image"]
    ];

    public function pesanan() {
        return $this->hasMany(Pesanan::class, "id");
    }

}
