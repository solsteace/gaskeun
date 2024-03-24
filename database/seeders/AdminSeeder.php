<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $samples = [
            "nama" => ["Julian", "Jessamine", "Jasmin", "Jujun", "Jojon"],
            "email" => [ 
                "JulianDoe@gmail.com",
                "JessamineBloom@gmail.com",
                "JasminFragerant@gmail.com",
                "JujunKoswadi@gmail.com",
                "JojonSumarjo@gmail.com"
            ]
        ];

        for($idx = 0; $idx < count($samples["nama"]); $idx++) {
            Admin::create([
                "nama" => $samples["nama"][$idx],
                "email" => $samples["email"][$idx],
                "password" => $samples["nama"][$idx],
                "image" => ""
            ]);
        }
    }
}
