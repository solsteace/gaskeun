<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pesanan;

class Pembayaran extends Model
{
    protected $fillable = ["status", "last_update"];
    protected $table = "Pembayaran";
    public $timestamps = false;
    use HasFactory;

    static $createRules = [
        "status" => [
            "required",
            "max:16",
        ],
        "last_update" => [
            "required",
            "date"
        ]
    ];

    static $editRules = [
        "status" => [
            "nullable",
            "max:16",
        ],
        "last_update" => [
            "nullable",
            "date"
        ]
    ];

    public function pesanan() {
        return $this->belongsTo(Pesanan::class, "id");
    }
}
