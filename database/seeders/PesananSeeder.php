<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pesanan;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $samples = [
            "id_pemesan" => [10, 8, 4],
            "id_mobil" => [1, 4, 5],
            "id_pembayaran" => [1, 2, 3],
            "titik_antar" =>  [
                "35.5679 -87.6543",
                null,
                "0.9876 23.4567"
            ],
            "titik_jemput" => [
                "34.5678 -87.6543",
                "-12.3456 45.6789",
                null
            ],
            "nama" => ["Jihan", "James", "Jonathan"]
        ];

        for($idx = 0; $idx < count($samples["nama"]); $idx++) {
            $random_date_begin = mt_rand(strtotime("2024-01-01"), strtotime("2024-03-24"));
            $random_date_end = mt_rand($random_date_begin, strtotime("2024-03-24"));
            Pesanan::create([
                "id_pemesan" => $samples["id_pemesan"][$idx],
                "id_mobil" => $samples["id_mobil"][$idx],
                "id_pembayaran" => $samples["id_pembayaran"][$idx],
                "SIM_peminjam" => "",
                "nama_peminjam" => $samples["nama"][$idx],
                "tanggal_peminjaman" => date("Y-m-d", $random_date_begin),
                "tanggal_pengembalian" => date("Y-m-d", $random_date_end),
                "titik_antar" => $samples["titik_antar"][$idx],
                "titik_jemput" => $samples["titik_jemput"][$idx]
            ]);
        }
    }
}
