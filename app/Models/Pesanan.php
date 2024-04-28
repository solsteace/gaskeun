<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\Models\Pengguna;
use App\Models\Mobil;
use App\Models\Pembayaran;

class Pesanan extends Model
{
    protected $fillable = [ 
        "id_pemesan", "id_mobil", "id_pembayaran",
        "SIM_peminjam", "nama_peminjam", 
        "tanggal_peminjaman", "tanggal_pengembalian",
        "titik_antar", "titik_jemput", "status"
    ];

    static function getCreateRules() {
        return [
            "id_pemesan" => ["required"], 
            "id_mobil" => ["required"], 
            "id_pembayaran" => ["required"], 
            "SIM_peminjam" => ["required"], 
            "nama_peminjam" => ["required"], 
            "tanggal_peminjaman" => ["required", "date"], 
            "tanggal_pengembalian" => ["required", "date"],
            "titik_antar" => ["nullable", "string"],
            "titik_jemput" => ["nullable", "string"],
            "status" => [
                "nullable", 
                Rule::in(["selesai", "belum_selesai"])
            ]
        ];
    }

    static function getEditRules() {
        return [
            "SIM_peminjam" => ["nullable"], 
            "nama_peminjam" => ["nullable"], 
            "tanggal_peminjaman" => ["nullable", "date"], 
            "tanggal_pengembalian" => ["nullable", "date"],
            "titik_antar" => ["nullable", "string"],
            "titik_jemput" => ["nullable", "string"],
            "status" => [
                "nullable", 
                Rule::in(["selesai", "belum_selesai"])
            ]
        ];
    } 

    protected $table = "Pesanan";
    public $timestamps = false;
    use HasFactory;

    public function pengguna() {
        return $this->belongsTo(Pengguna::class, "id_pengguna");
    }

    public function mobil() {
        return $this->belongsTo(Mobil::class, "id_mobil");
    }

    public function pembayaran() {
        return $this->belongsTo(Pembayaran::class, "id_pembayaran");
    }
}
