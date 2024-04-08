<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengguna;
use App\Models\Mobil;
use App\Models\Pembayaran;

class Pesanan extends Model
{
    protected $fillable = [ 
        "id_pemesan", "id_mobil", "id_pembayaran", "KTP_peminjam" ,
        "SIM_peminjam", "nama_peminjam", "tanggal_peminjaman", "tanggal_pengembalian"
    ];

    static $createRule = [
        "id_pemesan" => ["required"], 
        "id_mobil" => ["required"], 
        "id_pembayaran" => ["required"], 
        "KTP_peminjam" => ["required"],
        "SIM_peminjam" => ["required"], 
        "nama_peminjam" => ["required"], 
        "tanggal_peminjaman" => ["required"], 
        "tanggal_pengembalian" => ["required"],
    ];

    static $editRule = [
        "KTP_peminjam" => ["nullable"],
        "SIM_peminjam" => ["nullable"], 
        "nama_peminjam" => ["nullable"], 
        "tanggal_peminjaman" => ["nullable"], 
        "tanggal_pengembalian" => ["nullable"],
    ];

    protected $table = "Pesanan";
    public $timestamps = false;
    use HasFactory;

    public function pengguna() {
        return $this->belongsTo(Pengguna::class, "id_pemesan");
    }

    public function mobil() {
        return $this->hasOne(Mobil::class);
    }

    public function pembayaran() {
        return $this->hasOne(Pembayaran::class);
    }
}
