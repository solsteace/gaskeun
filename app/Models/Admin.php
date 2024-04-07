<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [ "nama", "email", "password", "image" ];
    protected $table = "admin";
    public $timestamps = false;
    use HasFactory;

    public function mobil() {
        return $this->hasMany(Mobil::class);
    }

    public function create() {}
    public function show() {}
    public function showByID($id) {}
    public function edit($id, $newData) {}
    public function destroy($id) {}
}
