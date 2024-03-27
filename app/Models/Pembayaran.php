<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pesanan;

class Pembayaran extends Model
{
    protected $table = "pembayaran";
    public $timestamps = false;
    use HasFactory;

    public function pesanan() {
        return $this->belongsTo(Pesanan::class, "id");
    }
}
