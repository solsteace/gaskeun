<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [ "nama", "email", "password", "image" ];
    protected $table = "Admin";
    public $timestamps = false;
    use HasFactory;

    public function mobil() {
        return $this->hasMany(Mobil::class);
    }
}
