<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $fillable = [ 
        "id_admin", "brand", "model", "kapasitas", "harga_sewa",
        "deskripsi", "image", "status", "nomor_polisi", "transmisi"
    ];
    protected $table = "mobil";
    public $timestamps = false;
    use HasFactory;

    public function admin() {
        return $this->belongsTo(Admin::class, "id_admin");
    }

    public function pesanan() {
        return $this->belongsTo(Pesanan::class, "id");
    }

    public function create() {}
    public function show() {}
    public function showByID($id) {}
    public function edit($id, $newData) {}
    public function destroy($id) {}
}
