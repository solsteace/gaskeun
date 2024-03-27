<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengguna;
use App\Models\Mobil;
use App\Models\Pembayaran;

class Pesanan extends Model
{
    protected $table = "pesanan";
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
