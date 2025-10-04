<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ImgPathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     //   DB::table('img_path')->insert([
       //    "product_id"=>38,
        //   "path"=>"images/device/samsung-galaxy-j7.png"
       // ]);

        DB::table('img_path')->insert([
             "product_id"=>93,
             "path"=>"images/device/nvidia-2202279_1280.jpg"
          ]);

        DB::table('img_path')->insert([
               "product_id"=>94,
               "path"=>"images/device/headphones-1720164_1280.jpg"
        ]);

        DB::table('img_path')->insert([
                 "product_id"=>94,
                 "path"=>"images/device/headphones-3683983_1280.jpg"
        ]);

        DB::table('img_path')->insert([
                   "product_id"=>95,
                   "path"=>"images/device/android-tv-game-controller-1535038_1280.jpg"
          ]);

    }
}
