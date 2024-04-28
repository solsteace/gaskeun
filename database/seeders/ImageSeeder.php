<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Images;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            "toyotaAvanza.jpg",
            "hondaJazz.jpg",
            "mitsubishiPajero.png",
            "nissanMarch.jpg",
            "suzukiXL7.jpg",
            "daihatsuSigra.jpg",
            "fordRanger.jpg"
        ];
        for($idx = 1; $idx <= 17; $idx++) {
            $random_date = mt_rand(strtotime("2024-01-01"), strtotime("2024-03-24"));
            $path = "{$idx}.jpg";
            if($idx > 10) {
                $path = "dumCars/{$images[$idx - 11]}" ;
            }

            Images::create([
                "path" => $path,
                "last_update" => date("Y-m-d", $random_date)
            ]);
        }
    }
}
