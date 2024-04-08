<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($idx = 0; $idx < 5; $idx++) {
            $random_date = mt_rand(strtotime("2024-01-01"), strtotime("2024-03-24"));
            Pembayaran::create([
                "status" => ["lunas", "belum_lunas"][round(microtime(true)) % 2],
                "last_update" => date("Y-m-d", $random_date)
            ]);
        }
    }
}
