<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pesanan;

class Pembayaran extends Model
{
    protected $fillable = [ "status", "last_update"];
    protected $table = "pembayaran";
    public $timestamps = false;
    use HasFactory;

    public function pesanan() {
        return $this->belongsTo(Pesanan::class, "id");
    }

    public function create() {}
    public function show() {}
    public function showByID($id) {}
    public function edit($id, $newData) {}
    public function destroy($id) {}
}
