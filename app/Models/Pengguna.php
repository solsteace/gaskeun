<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pesanan;

class Pengguna extends Model
{
    protected $fillable = [ "nama", "email", "password", "image", "role" ];
    protected $table = "pengguna";
    public $timestamps = false;
    use HasFactory;

    public function pesanan() {
        return $this->hasMany(Pesanan::class, "id");
    }

    public function create() {}
    public function show() {}
    public function showByID($id) {}
    public function edit($id, $newData) {}
    public function destroy($id) {}
}
