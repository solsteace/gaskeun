<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pesanan;

class Pengguna extends Model
{
    protected $fillable = [ "nama", "email", "password", "image", "role" ];
    protected $table = "Pengguna";
    public $timestamps = false;
    use HasFactory;

    public function pesanan() {
        return $this->hasMany(Pesanan::class, "id");
    }

}
