<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $table = "mobil";
    public $timestamps = false;
    use HasFactory;

    public function admin() {
        return $this->belongsTo(Admin::class, "id_admin");
    }

    public function pesanan() {
        return $this->belongsTo(Pesanan::class, "id");
    }
}
