<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\Models\Pesanan;

class Pembayaran extends Model
{
    protected $fillable = ["status", "last_update"];
    protected $table = "Pembayaran";
    public $timestamps = false;
    use HasFactory;

    static function getCreateRules() {
        return [
            "status" => [
                "required",
                "max:16",
                Rule::in(["lunas", "belum_lunas"])
            ],
            "last_update" => [
                "nullable",
                "date"
            ]
        ];
    }

    static function getEditRules() {
        return [
            "status" => [
                "nullable",
                "max:16",
                Rule::in(["lunas", "belum_lunas"])
            ],
            "last_update" => [
                "nullable",
                "date"
            ]
        ];
    }

    public function pesanan() {
        return $this->hasOne(Pesanan::class, "id");
    }
}
