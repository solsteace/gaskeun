<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = "admin";
    protected $fillable = [ "nama", "email", "password", "image" ];

    public $timestamps = false;
    use HasFactory;

    public function mobil() {
        return $this->hasMany(Mobil::class);
    }

    public function create() {}
    public function show() {}
    public function edit() {}
    public function destroy() {}
}
