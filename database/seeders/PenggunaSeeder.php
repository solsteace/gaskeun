<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $samples = [
            "nama" => ["Jono", "Jeni", "Jeremi", "Jane", "Jajang", "Juliarso", "Jessica", "James", "Jalu", "Jihan"],
            "email" => [ 
                "JonoSurono@gmail.com",
                "JeniSutami@gmail.com",
                "JeremiPaul@gmail.com",
                "JaneAlicia@gmail.com",
                "JajangSujaman@gmail.com",
                "JuliarsoAkbar@gmail.com",
                "JessicaMillau@gmail.com",
                "JamesMccallahan@gmail.com",
                "JaluWibowo@gmail.com",
                "JihanHani@gmail.com"
            ]
        ];

        for($idx = 0; $idx < count($samples["nama"]); $idx++) {
            Pengguna::create([
                "nama" => $samples["nama"][$idx],
                "email" => $samples["email"][$idx],
                "password" => Hash::make($samples["nama"][$idx]),
                "id_image" => $idx + 1,
            ]);
        }
    }
}
