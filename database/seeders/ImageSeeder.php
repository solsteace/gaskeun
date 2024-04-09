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
        $random_date = mt_rand(strtotime("2024-01-01"), strtotime("2024-03-24"));
        Images::create([
            "path" => "default.jpg",
            "last_update" => date("Y-m-d", $random_date)
        ]);
    }
}
