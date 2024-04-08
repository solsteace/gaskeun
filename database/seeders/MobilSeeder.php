<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mobil;

class MobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $samples = [
            "brand" => ["Toyota", "Honda", "Mitsubishi", "Nissan", "Suzuki", "Daihatsu", "Ford"],
            "model" => ["Avanza", "Jazz", "Pajero Sport", "March", "XL7", "Sigra", "Ranger"],
            "kapasitas" => [7, 5, 7, 5, 7, 7, 5],
            "hargaSewa" => [300_000, 250_000, 400_000, 200_000, 350_000, 270_000, 450_000],
            "deskripsi" => [
                "Mobil keluarga dengan kursi 7 penumpang.",
                "Hatchback sporty dengan ruang kabin luas.",
                "SUV tangguh dengan performa prima di segala medan.",
                "City car dengan desain kompak dan efisien bahan bakar.",
                "MPV premium dengan ruang kabin mewah.",
                "MPV ekonomis dengan fitur lengkap.",
                "Pickup tangguh dengan performa dan ketangguhan di segala medan."
            ],
            "image" => [ "", "", "", "", "", "", "", ""],
            "status" => ["tidak_tersedia", "tersedia", "tersedia", "tidak_tersedia", "tidak_tersedia", "tersedia", "tersedia"],
            "nomorPolisi" => [
                "B 1234 ABC",
                "B 5678 DEF",
                "B 2468 GHI",
                "B 1357 JKL",
                "B 9753 MNO",
                "B 3579 PQR",
                "B 8023 STU"
            ],
            "transmisi" => ["manual", "matic", "matic", "manual", "matic", "manual", "manual"],
        ];

        for($idx = 0; $idx < count($samples["brand"]); $idx++) {
            Mobil::create([
                "brand" => $samples["brand"][$idx],
                "model" => $samples["model"][$idx],
                "kapasitas" => $samples["kapasitas"][$idx],
                "harga_sewa" => $samples["hargaSewa"][$idx],
                "deskripsi" => $samples["deskripsi"][$idx],
                "image" => $samples["image"][$idx],
                "status" => $samples["status"][$idx],
                "nomor_polisi" => $samples["nomorPolisi"][$idx],
                "transmisi" => $samples["transmisi"][$idx],
                "id_pengguna" => 1,
            ]);
        }
    }
}
