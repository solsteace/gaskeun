<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengguna;
use App\Models\Mobil;

class Images extends Model
{
    protected $fillable = ["path", "last_update"];
    protected $table = "Images";
    public $timestamps = false;
    use HasFactory;

    public function pengguna() {
        return $this->belongsTo(Pengguna::class, "id");
    }
    public function mobil() {
        return $this->belongsTo(Mobil::class, "id");
    }
}
